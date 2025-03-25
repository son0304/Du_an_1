<<<<<<< HEAD
<?php 
    require_once '../../Config/config.php';
    require_once '../../Controller/productController.php';
    require_once '../../Controller/userController.php';
    require_once '../../Controller/orderController.php';
    require_once '../../Controller/loginController.php';

    include_once '../../Layout/Admin/header.php';
    $action = $_GET['action'] ?? 'home';
    $controllerProduct = new ProductController($conn);
    $controllerUser = new UserController($conn);
    $controllerOrder = new OrderController($conn);
    $loginController = new LoginController($conn);

    switch ($action) {
        // Order
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

        // Product
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

        // User 
        case 'users':
            $controllerUser->listUser();
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

        // Logout
        case 'logout':
            $loginController->logout();
            break;

        // Default
        default:
            echo "Chào mừng đến với trang quản trị!";
            break;
    }
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- Use the full path to ensure proper routing -->
    <a href="/Du_an_1/View/Client/index.php?action=logout">
        <button type="button">Đăng xuất</button>
    </a>
</body>
</html>
