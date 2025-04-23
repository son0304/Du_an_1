<?php
require_once __DIR__ . '/../Config/config.php';
require_once __DIR__ . '/../Controller/productController.php';
require_once __DIR__ . '/../Controller/orderController.php';
require_once __DIR__ . '/../Controller/cartController.php';
require_once __DIR__ . '/../Controller/contactController.php';

$action = $_GET['action'] ?? 'home';
$controllerProduct = new ProductController($conn);
$controllerOrder = new OrderController($conn);
$controllerCart = new CartController($conn);
$controllerContact = new ContactController($conn);

switch ($action) {

    // Product Management
    case 'product':
        $controllerProduct->listProductClient();
        break;
    case 'order':
        $controllerOrder->createOrder();
        break;
    case 'order':
        $controllerOrder->createOrder();
        break;
    case 'listOrder':
        $controllerOrder->listOrdersByUser();
        break;
    case 'detailOrder':
        $controllerOrder->detailOrderClient();
        break;
    case 'addToCart':
        $controllerCart->addToCart();
        break;
    case 'viewCart':
        $controllerCart->viewCart();
        break;
    case 'removeFromCart':
        $controllerCart->removeFromCart();
        break;
    case 'home':
        require_once '../../View/Client/home/home.php';
        break;
    case 'contact':
        $controllerContact->addContact();
        break;

    default:
        echo "Chào mừng đến với trang cLIENT";
        break;
}
