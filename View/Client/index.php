<?php 
require_once '../../Config/config.php';
require_once '../../Controller/loginController.php';
require_once '../../Controller/registerController.php';
include_once '../../Layout/Client/header.php';

$action = $_GET['action'] ?? 'home';
$controllerLogin = new LoginController($conn);
$controllerRegister = new RegisterController($conn);

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
    
    case 'registerform' :
        $controllerRegister->formRegister();
        break;
    case 'register':
        $controllerRegister->register();
        break;
}