<?php
require_once '../../Config/config.php';


// if (!isset($_SESSION['user'])) {
//     header("Location: /Du_an_1/View/Auth/404.php");
//     exit();
// }

if ($_SESSION['user']['role'] != 1) {
    header("Location: ". BASE_URL . "View/Client/index.php");
    exit();
}

