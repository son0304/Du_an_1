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
        echo $date;
        $currentDate = new DateTime($date);

        // Ngày hôm trước
        $previousDay = $currentDate->modify('-1 day')->format('Y-m-d');
        $currentDate->modify('+1 day'); // reset lại về ngày gốc

        // Tuần trước
        $previousWeek = $currentDate->modify('-1 week')->format('Y-m-d');
        $currentDate->modify('+1 week'); // reset

        // Tháng trước
        $previousMonth = $currentDate->modify('-1 month')->format('Y-m-d');
        $currentDate->modify('+1 month');

        // Năm trước
        $previousYear = $currentDate->modify('-1 year')->format('Y-m-d');

        // Thống kê cho các ngày trước
        $statByDay = $this->statisticModel->getStatisticByDay($date, $status);
        $statByDayPrevious = $this->statisticModel->getStatisticByDay($previousDay, $status);

        $statByWeek = $this->statisticModel->getStatisticByWeek($date, $status);
        $statByWeekPrevious = $this->statisticModel->getStatisticByWeek($previousWeek, $status);

        $statByMonth = $this->statisticModel->getStatisticByMonth($date, $status);
        $statByMonthPrevious = $this->statisticModel->getStatisticByMonth($previousMonth, $status);

        $statByYear = $this->statisticModel->getStatisticByYear($date, $status);
        $statByYearPrevious = $this->statisticModel->getStatisticByYear($previousYear, $status);

        // Gửi các dữ liệu sang View
        include_once __DIR__ . '/../View/Admin/masters/master.php';
    }
}
