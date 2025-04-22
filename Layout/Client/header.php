<?php
require_once __DIR__ . '/../../Config/config.php'; // điều chỉnh đường dẫn nếu khác
require_once __DIR__ . '/../../Model/settingModel.php';
require_once __DIR__ . '/../../Model/CartModel.php';

$settingModel = new SettingModel($conn);
$settings = $settingModel->listSettingModel();

$cartItemCount = 0;
if (isset($_SESSION['user'])) {
    $cartModel = new CartModel($conn);
    $id_user = $_SESSION['user']['id'];
    $cart = $cartModel->getCartByIdUser($id_user);
    if ($cart) {
        $cartItemCount = $cartModel->countCartItems($cart['id']);
    }
}
?>

<?php if (!empty($settings)) : ?>
    <?php $setting = $settings[0]; ?>
<?php endif; ?>

<header class="header-area header-sticky text-white py-3 ">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">

            <!-- Logo -->
            <h1 class="m-0 text-white"><?= $setting['set1'] ?></h1>

            <!-- Navigation Menu -->
            <ul class="d-flex list-unstyled gap-4 m-0">
                <li><a href="?action=home" class="text-white text-decoration-none"><?= $setting['set2'] ?></a></li>
                <li><a href="?action=product" class="text-white text-decoration-none"><?= $setting['set3'] ?></a></li>
                <li><a href="?action=listOrder" class="text-white text-decoration-none"><?= $setting['set4'] ?></a></li>
                <li><a href="?action=contact" class="text-white text-decoration-none"><?= $setting['set5'] ?></a></li>


            </ul>

            <!-- Cart & Sign In -->
            <div class="d-flex align-items-center gap-5">
                <a href="?action=viewCart" class="text-white position-relative mt-1">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <?php if ($cartItemCount > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?= $cartItemCount ?>
                        </span>
                    <?php endif; ?>
                </a>


                <!-- Sign In Button -->
                <?php
                if (isset($_SESSION['user'])) {
                    echo ' 
                      <div class="text-center">
                       
                        <a href="dashboard.php" class="text-white text-decoration-none"><i class="fas fa-user fa-lg"></i></a>
                        <p class="text-white text-decoration-none">' . $_SESSION['user']['name'] . '</p>
                      </div>
                       <a href="http://localhost/Du_an_1/View/Auth/logout.php" class="text-white text-decoration-none"><i class="fas fa-sign-out-alt fa-lg"></i></a>
                       ';
                } else {
                    echo ' <a href="http://localhost/Du_an_1/View/Auth/login.php" class="btn btn-danger rounded-pill px-3 py-1">
                       Sign in
                   </a>';
                }
                ?>
            </div>
        </div>
    </div>
</header>