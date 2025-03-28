<?php


define('BASE_URL', 'http://localhost/Du_an_2/');
define('BASE_URL_CSS', BASE_URL . 'Assets/css/');
define('ADMIN_URL_CSS', BASE_URL_CSS . 'admin/');
define('CLIENT_URL_CSS', BASE_URL_CSS . 'client/');

$host = "localhost";
$username = "root";
$password = "";
$database = "sweet_cake";
$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("❌ Kết nối thất bại: " . $conn->connect_error);
}

define('STATUS_UNCOMFIRMED', 'Chờ xác nhận');
define('STATUS_CONFIRMED', 'Đã xác nhận');
define('STATUS_SHIPPED', 'Đã giao');
define('STATUS_CANCELLED', 'Đã hủy');
