<?php
ob_start();
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../Auth/404.php");
    exit();
}
require_once '../Auth/authMiddleware.php';
?>


<?php require_once '../../Layout/Admin/head.php' ?>

<body>

</body>
</html> 
<body id="page-top">
    <div id="wrapper">
        <?php require_once '../../Layout/Admin/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php require_once '../../Layout/Admin/topbar.php' ?>
                <div class="container-fluid">
                    <div class="m-3 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                        <?php require_once '../../Router/adminRouter.php'; ?>

                    </div>
                </div>

            </div>
            <?php require_once '../../Layout/Admin/footer.php' ?>
        </div>
    </div>
    <?php require_once '../../Layout/Admin/script.php' ?>
</body>

</html>