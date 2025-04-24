<?php

require_once __DIR__ . '/../Model/statisticModel.php';

class StatisticController
{
    private $statisticModel;

    public function __construct($db)
    {
        $this->statisticModel = new StatisticModel($db);
    }

    public function listStatisticStatus()
    {
        $status = 'hoàn tất';
        $date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
        $currentDate = new DateTime($date);

        // Lấy dữ liệu cho 7 ngày gần nhất
        $statByDay = [];
        $statByDayPrevious = [];
        for ($i = 6; $i >= 0; $i--) {
            $statDate = clone $currentDate;
            $statDate->modify("-$i day");
            $stat = $this->statisticModel->getStatisticByDay($statDate->format('Y-m-d'), $status);
            $statByDay[] = $stat;
            if ($i == 1) {
                $statByDayPrevious = $stat;
            }
        }

        // Lấy dữ liệu cho 4 tuần gần nhất
        $statByWeek = [];
        $statByWeekPrevious = [];
        for ($i = 3; $i >= 0; $i--) {
            $statDate = clone $currentDate;
            $statDate->modify("-$i week");
            $stat = $this->statisticModel->getStatisticByWeek($statDate->format('Y-m-d'), $status);
            $statByWeek[] = $stat;
            if ($i == 1) {
                $statByWeekPrevious = $stat;
            }
        }

        // Lấy dữ liệu cho 6 tháng gần nhất
        $statByMonth = [];
        $statByMonthPrevious = [];
        for ($i = 5; $i >= 0; $i--) {
            $statDate = clone $currentDate;
            $statDate->modify("-$i month");
            $stat = $this->statisticModel->getStatisticByMonth($statDate->format('Y-m'), $status);
            $statByMonth[] = $stat;
            if ($i == 1) {
                $statByMonthPrevious = $stat;
            }
        }

        // Lấy dữ liệu cho 2 năm gần nhất
        $statByYear = [];
        $statByYearPrevious = [];

        // Lấy năm hiện tại
        $currentYear = $currentDate->format('Y');
        $stat = $this->statisticModel->getStatisticByYear($currentYear . '-01-01', $status);
        if ($stat['revenue'] > 0) {
            $statByYear[] = $stat;
        }

        // Lấy năm trước
        $previousYear = (int)$currentYear - 1;
        $stat = $this->statisticModel->getStatisticByYear($previousYear . '-01-01', $status);
        if ($stat['revenue'] > 0) {
            $statByYearPrevious = $stat;
        }

        // Debug thông tin
        error_log("Current Year Data: " . print_r($statByYear, true));
        error_log("Previous Year Data: " . print_r($statByYearPrevious, true));

        // Gửi các dữ liệu sang View
        include_once __DIR__ . '/../View/Admin/masters/master.php';
    }
}
