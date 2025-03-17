    <?php 
    require_once '../../Config/config.php' ;
    require_once '../../Controller/productController.php' ;
    require_once '../../Controller/userController.php';
    include_once '../../Layout/Admin/header.php';
    $action = $_GET['action'] ?? 'home';
    $controllerProduct = new ProductController($conn);
    $controllerUser = new UserController($conn);


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
        //User 
        case 'users': // Thêm trường hợp cho danh sách người dùng
            $controllerUser ->listUser();
            break;
        case 'form-edit':
            $controllerUser->formEdit($_GET['id']);
            break;
        case 'editUser':
            $controllerUser->editUser();
            break;
        case 'deleteUser':
            $controllerUser->deleteUser();
            break;
    }

    // include_once '../../Layout/Admin/footer.php';

    ?>
