<?php

require_once __DIR__ . '/../Config/config.php';

class StatisticModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function countOrder()
    {
        $sql = "SELECT COUNT(*) as total_orders FROM orders";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_orders'];
    }
    public function countOrderByStatus($status)
    {
        $sql = "SELECT COUNT(*) as total_orders FROM orders WHERE status = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $status);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total_orders'];
    }

    public function listStatisticStatus($status)
    {
        $sql = "SELECT * FROM orders WHERE status = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function sumTotalPrice($status)
    {
        $sql = "SELECT SUM(total_price) AS total FROM orders WHERE status = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'] ?? 0;
    }

    public function getStatisticByDay($date, $status)
    {
        $sql = "SELECT 
                YEAR(received_date) AS year,
                MONTH(received_date) AS month,
                DAY(received_date) AS day,
                COUNT(*) AS total_orders,
                SUM(total_price) AS revenue
            FROM orders 
            WHERE DATE(received_date) = ? AND status = ? 
            GROUP BY YEAR(received_date), MONTH(received_date), DAY(received_date)
            ORDER BY year DESC, month DESC, day DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ?: ['revenue' => 0, 'total_orders' => 0];
    }


    // Hàm thống kê theo tuần với tham số $date và $status
    public function getStatisticByWeek($date, $status)
    {
        $sql = "SELECT 
                YEAR(received_date) AS year, 
                WEEK(received_date, 1) AS week, 
                COUNT(*) AS total_orders,
                SUM(total_price) AS revenue
            FROM orders 
            WHERE YEARWEEK(received_date, 1) = YEARWEEK(?, 1) 
            AND status = ?
            GROUP BY YEAR(received_date), WEEK(received_date, 1)
            ORDER BY year DESC, week DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ?: ['revenue' => 0, 'total_orders' => 0];
    }

    // Hàm thống kê theo tháng với tham số $status và $date
    public function getStatisticByMonth($date, $status)
    {
        $sql = "SELECT 
                YEAR(received_date) AS year, 
                MONTH(received_date) AS month, 
                COUNT(*) AS total_orders,
                SUM(total_price) AS revenue
            FROM orders 
            WHERE DATE_FORMAT(received_date, '%Y-%m') = ? AND status = ?
            GROUP BY YEAR(received_date), MONTH(received_date)
            ORDER BY year DESC, month DESC";

        $date = date('Y-m', strtotime($date));
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ?: ['revenue' => 0, 'total_orders' => 0];
    }
    // Hàm thống kê theo năm với tham số $status và $date
    public function getStatisticByYear($date, $status)
    {
        $year = (int)date('Y', strtotime($date));
        $sql = "SELECT 
                YEAR(received_date) AS year,
                COUNT(*) AS total_orders,
                COALESCE(SUM(total_price), 0) AS revenue
            FROM orders 
            WHERE YEAR(received_date) = ? AND status = ?
            GROUP BY YEAR(received_date)";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $year, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Debug thông tin
        error_log("Year: " . $year);
        error_log("SQL Query: " . $sql);
        error_log("Row data: " . print_r($row, true));

        if ($row) {
            return [
                'year' => $row['year'],
                'total_orders' => $row['total_orders'],
                'revenue' => $row['revenue']
            ];
        }

        return [
            'year' => $year,
            'total_orders' => 0,
            'revenue' => 0
        ];
    }
}
