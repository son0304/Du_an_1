<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: /Du_an_2/View/Auth/login.php");
    exit();
}

if ($_SESSION['user']['role'] !== 1) {
    header("Location: . BASE_URL . View/Client/index.php");
    exit();
}
?>
