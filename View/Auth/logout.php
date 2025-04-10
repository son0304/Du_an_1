<?php
require_once __DIR__ .  '/../../Config/config.php';
require_once __DIR__ . '/../../Config/config.php';

session_start();
session_unset();
session_destroy();

header("Location: " . BASE_URL . "View/Auth/login.php"); 
exit();
