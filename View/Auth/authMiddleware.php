<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: " . BASE_URL . "View/Auth/login.php");
    exit();
}

if ($_SESSION['user']['role'] !== 1) {
    header("Location: " . BASE_URL . "View/Client/index.php");
    exit();
}
?>
