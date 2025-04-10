<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../Auth/404.php");
    exit();
}
?>

<?php require_once '../../Layout/Admin/head.php' ?>

<body id="page-top">
    <div id="wrapper">
        <?php require_once '../../Layout/Admin/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">

                <?php require_once '../../Layout/Admin/topbar.php' ?>

                <div class="container-fluid">
                    <div class="m-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded">




                        <?php
                        require_once '../../Config/config.php';
                        require_once '../../Controller/productController.php';
                        require_once '../../Controller/orderController.php';
                        require_once  '../../Controller/categoriesController.php';
                        require_once  '../../Controller/userController.php';


                        $action = $_GET['action'] ?? 'home';
                        $controllerProduct = new ProductController($conn);
                        $categories = new categoriesController($conn);
                        $controllerOrder = new OrderController($conn);
                        $controllerUser = new UserController($conn);



                        switch ($action) {
                            //Usser
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

                            //order
                            // case 'orders':
                            //     $controllerOrder->listOrder();
                            //     break;

                            // case 'updateOrder':
                            //     $controllerOrder->updateOrder();
                            //     break;

                            // case 'deleteOrder':
                            //     $controllerOrder->deleteOrder();
                            //     break;


                            //categories
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



                            //Product
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
                        ?>
                    </div>

                </div>

            </div>
            <?php require_once '../../Layout/Admin/footer.php' ?>
        </div>
    </div>
    <?php require_once '../../Layout/Admin/script.php' ?>

</body>

</html>