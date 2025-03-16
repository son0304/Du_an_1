<?php
define('BASE_URL_CSS', 'http://localhost/Du_an_1/Assets/css/');
define('ADMIN_URL__CSS', BASE_URL_CSS . 'admin/');
define('CLIENT_URL_CSS', BASE_URL_CSS . 'client/');

$host = "localhost";
$username = "root";
$password = "";
$database = "sweet_cake";
$conn = new mysqli($host, $username, $password, $database);

if ($conn) {
    // echo "kết nối thành công";
}else{
    echo "Kết nối thât bại";
}

?>
