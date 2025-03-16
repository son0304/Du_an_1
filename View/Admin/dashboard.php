<?php 
require_once '../../Config/config.php' ;
require_once '../../Controller/productController.php' ;
require_once '../../Controller/orderController.php' ;
include_once '../../Layout/Admin/header.php';
$action = $_GET['action'] ?? 'home';
$controllerProduct = new ProductController($conn);
$controllerOrder = new OrderController($conn);

switch ($action) {

    //order
    case 'orders':
        $controllerOrder->listOrder();
        break;

    case 'createOrder':
        $controllerOrder->createOrder();
        break;

    // case 'edit-product':
    //     $controllerOrder->updateOrder();
    //     break;

    // case 'delete-product':
    //     $controllerOrder->detailOrder();
    //     break;


    
    //Product
    case 'product':
        $controllerProduct->listProduct();
        break;

    case 'createProduct':
        $controllerProduct->createProduct();
        break;

    case 'edit-product':
        $controllerProduct->updateProduct();
        break;

    case 'delete-product':
        $controllerProduct->detailProduct();
        break;

    default:
        echo "Chào mừng đến với trang quản trị!";
        break;
}
include_once '../../Layout/Admin/footer.php';

?>
