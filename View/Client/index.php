<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../Auth/404.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once '../../Layout/Client/head.php' ?>

<body>
    <?php require_once '../../Layout/Client/header.php' ?>
    <?php require_once  '../../Layout/Client/banner.php' ?>
    <div class="section trending">
        <div class="container">

            <div class="row">
                <?php
                require_once '../../Config/config.php';
                require_once '../../Controller/productController.php';
                require_once '../../Controller/cartController.php';
                require_once '../../Controller/orderController.php';



                $act = $_GET['act'] ?? 'home';
                $controllerProduct = new ProductController($conn);
                $controllerCart = new CartController($conn);
                $controllerOrder = new OrderController($conn);
                switch ($act) {

                    case 'product':
                        $controllerProduct->listProductClient();
                        break;

                    case 'viewCart':
                        $controllerCart->viewCart();
                        break;

                    case 'order':
                        $controllerOrder->createOrder();
                        break;
                    case 'addToCart':
                        $controllerCart->addToCart();
                        break;
                    case 'removeFromCart':
                        $controllerCart->removeFromCart();
                        break;
                    case 'home':
                        require_once '../../View/Client/home/home.php';
                        break;
                    case 'contact':
                        require_once '../../View/Client/contact/contact.php';
                        break;

                    default:
                        echo "error";
                        break;
                }

                ?>
            </div>
        </div>
    </div>
    <?php require_once '../../Layout/Client/footer.php' ?>

    <?php require_once '../../Layout/Client/script.php' ?>

</body>

</html>