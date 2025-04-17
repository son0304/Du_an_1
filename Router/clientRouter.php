<?php
require_once '../../Config/config.php';
require_once '../../Controller/productController.php';
require_once '../../Controller/orderController.php';
require_once '../../Controller/cartController.php';

$action = $_GET['action'] ?? 'home';
$controllerProduct = new ProductController($conn);
$controllerOrder = new OrderController($conn);
$controllerCart = new CartController($conn);


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
        require_once '../../View/Client/contacts/contact.php';
        break;

    default:
        echo "Chào mừng đến với trang cLIENT";
        break;
}
