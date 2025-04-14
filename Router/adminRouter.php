<?php
require_once '../../Config/config.php';
require_once '../../Controller/productController.php';
require_once '../../Controller/orderController.php';
require_once '../../Controller/categoriesController.php';
require_once '../../Controller/userController.php';

$action = $_GET['action'] ?? 'home';
$controllerProduct = new ProductController($conn);
$categories = new categoriesController($conn);
$controllerOrder = new OrderController($conn);
$controllerUser = new UserController($conn);

switch ($action) {
    // User Management
    case 'users':
        $controllerUser->listUser();
        break;
    case 'createUser':
        $controllerUser->createUser();
        break;
    case 'updateUser':
        $controllerUser->updatetUser();
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

    default:
        echo "Chào mừng đến với trang quản trị!";
        break;
}
