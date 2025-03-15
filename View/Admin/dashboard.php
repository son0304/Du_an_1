<?php 
require_once '../../Config/config.php' ;
require_once '../../Controller/productController.php' ;
include_once '../../Layout/Admin/header.php';
$action = $_GET['action'] ?? 'home';
$controllerProduct = new ProductController($conn);


switch ($action) {

//order



    
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
