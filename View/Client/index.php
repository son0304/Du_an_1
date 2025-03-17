<?php 
require_once '../../Config/config.php';
require_once '../../Controller/loginController.php';
include_once '../../Layout/Client/header.php';

$action = $_GET['action'] ?? 'home';
$controllerLogin = new LoginController($conn);

switch($action) {
    case 'form':
        $controllerLogin->form();
        break;
    case 'login':
        $controllerLogin->login();
        break;
    case 'logout':
        $controllerLogin->logout();
        break;

}