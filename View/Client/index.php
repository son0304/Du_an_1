<?php
session_start();
if (!isset($_SESSION['user'])) {
    // header("Location: ../Auth/404.php");
    // exit();
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
            <?php require_once '../../Router/clientRouter.php'; ?>


        </div>
    </div>
    <?php require_once '../../Layout/Client/footer.php' ?>

    <?php require_once '../../Layout/Client/script.php' ?>

</body>



</html>