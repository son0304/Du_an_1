





<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sweet-Cake</title>

    <!-- Custom fonts for this template-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS (bao gồm Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link href="../../Assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../Assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body>

    <a href="/Du_an_1/View/Client/index.php?action=logout">
        <button type="button">Đăng xuất</button>
    </a>
</body>
</html> 
<body id="page-top">

    <!-- Page Wrapper -->
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
                        require_once '../../Controller/categoriesController.php';
                        require_once '../../Controller/userController.php';

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
                            case 'updateUser':
                                $controllerUser->updateUser($_GET['id']);
                                break;
                            case 'deleteUser':
                                $controllerUser->deleteUser();
                                break;

                            //order
                            case 'orders':
                                $controllerOrder->listOrder();
                                break;
                            case 'createOrder':
                                $controllerOrder->createOrder();
                                break;

                            case 'updateOrder':
                                $controllerOrder->updateOrder();
                                break;

                            case 'deleteOrder':
                                $controllerOrder->deleteOrder();
                                break;


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



                                //Product
                            case 'product':
                                $controllerProduct->listProduct();
                                break;

                            case 'createProduct':
                                $controllerProduct->createProduct();
                                break;

                            case 'updateProduct':
                                $controllerProduct->updateProduct($_GET['id']);
                                break;
                            case 'deleteProduct':
                                $controllerProduct->deleteProduct();


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





    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../../Layout/Admin/script.php' ?>

</body>

</html>

