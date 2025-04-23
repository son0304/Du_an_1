<?php
require_once '../../Config/config.php';
require_once '../../Controller/productController.php';
require_once '../../Controller/orderController.php';
require_once '../../Controller/categoriesController.php';
require_once '../../Controller/userController.php';
require_once '../../Controller/settingController.php';
require_once '../../Controller/contactController.php';


$action = $_GET['action'] ?? 'home';
$controllerProduct = new ProductController($conn);
$categories = new categoriesController($conn);
$controllerOrder = new OrderController($conn);
$controllerUser = new UserController($conn);
$controllerSetting = new SettingController($conn);
$controllerContact = new ContactController($conn);

switch ($action) {
    case 'home':
        require_once '../../View/Admin/masters/master.php';
        break;
    // User Management
    case 'users':
        $controllerUser->listUser();
        break;
    case 'createUser':
        $controllerUser->createUser();
        break;
    case 'updateUser':
        $controllerUser->updateUser();
        break;
    case 'deleteUser':
        $controllerUser->deleteUser();
        break;

    // Order Management
    case 'orders':
        $controllerOrder->listOrders();
        break;

    case 'detailOrder':
        $controllerOrder->detailOrderAdmin();
        break;

    // Category Management
    case 'categories':
        $categories->listCategory();
        break;
    case 'createCategory':
        $categories->createCategory();
        break;
    case 'updateCategory':
        $categories->updateCategory();
        break;
    case 'deleteCategory':
        $categories->deleteCategory();
        break;

    // Product Management
    case 'product':
        $controllerProduct->listProduct();
        break;
    case 'createProduct':
        $controllerProduct->createProduct();
        break;
    case 'updateProduct':
        $controllerProduct->updateProduct();
        break;
    case 'deleteProduct':
        $controllerProduct->deleteProduct();
        break;

    //Setting
    case 'settings':
        $controllerSetting->listSetting();
        break;
    case 'updateSetting':
        $controllerSetting->updateSetting();
        break;

    //Contacts
    case 'contacts':
        $controllerContact->viewContact();
        break;
    case 'updateContact':
        $controllerContact->updateContactStatus();
        break;
    case 'deleteContact':
        $controllerContact->deleteContact();
        break;
    default:
        echo "Chào mừng đến với trang quản trị!";
        break;
}
