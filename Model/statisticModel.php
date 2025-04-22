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
                SUM(total_price) AS total_price
            FROM orders 
            WHERE DATE(received_date) = ? AND status = ? 
            GROUP BY YEAR(received_date), MONTH(received_date), DAY(received_date)
            ORDER BY year DESC, month DESC, day DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    // Hàm thống kê theo tuần với tham số $date và $status
    public function getStatisticByWeek($date, $status)
    {
        $sql = "SELECT 
                YEAR(received_date) AS year, 
                WEEK(received_date, 1) AS week, 
                COUNT(*) AS total_orders,
                SUM(total_price) AS total_price
            FROM orders 
            WHERE YEARWEEK(received_date, 1) = YEARWEEK(?, 1) 
            AND status = ?
            GROUP BY YEAR(received_date), WEEK(received_date, 1)
            ORDER BY year DESC, week DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Hàm thống kê theo tháng với tham số $status và $date
    public function getStatisticByMonth($date, $status)
    {
        $sql = "SELECT 
                YEAR(received_date) AS year, 
                MONTH(received_date) AS month, 
                COUNT(*) AS total_orders,
                SUM(total_price) AS total_price
            FROM orders 
            WHERE YEAR(received_date) = YEAR(?) AND MONTH(received_date) = MONTH(?) AND status = ?
            GROUP BY YEAR(received_date), MONTH(received_date)
            ORDER BY year DESC, month DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $date, $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    // Hàm thống kê theo năm với tham số $status và $date
    public function getStatisticByYear($date, $status)
    {
        $sql = "SELECT 
                YEAR(received_date) AS year, 
                COUNT(*) AS total_orders,
                SUM(total_price) AS total_price
            FROM orders 
            WHERE YEAR(received_date) = YEAR(?) AND status = ?
            GROUP BY YEAR(received_date)
            ORDER BY year DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $date, $status);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
