<!DOCTYPE html>
<html lang="en">

<?php require_once '../../Layout/Client/head.php' ?>

<body>

    <?php require_once '../../Layout/Client/header.php' ?>

    <?php require_once  '../../Layout/Client/banner.php' ?>

    



    <div class="section trending">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h6>Trending</h6>
                        <h2>Trending Cakes</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="main-button">
                        <a href="shop.html">View All</a>
                    </div>
                </div>

        <?php 
        require_once '../../Config/config.php';
        require_once '../../Controller/client/categoryController.php';
        require_once '../../Controller/client/productController.php';
        $action = $_GET['action'] ?? 'home';
        $controllerCategory = new categoryController($conn);
        $controllerProduct = new ProductController($conn);

        switch($action){
            case 'category':
                $controllerCategory->listCategoriesWithProducts();
                break;
            case 'products':
                $controllerProduct->listProduct();
                break;
            case 'productDetail':
                $controllerProduct->detailProduct($_GET['id']);
                break;
        }

        
        ?>

                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="../../Assets/client/assets/images/trending-01.jpg" alt=""></a>

                        </div>
                        <div class="down-content">
                            <span class="category">Action</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="../../Assets/client/assets/images/trending-02.jpg" alt=""></a>

                        </div>
                        <div class="down-content">
                            <span class="category">Action</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="../../Assets/client/assets/images/trending-03.jpg" alt=""></a>

                        </div>
                        <div class="down-content">
                            <span class="category">Action</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="item">
                        <div class="thumb">
                            <a href="product-details.html"><img src="../../Assets/client/assets/images/trending-04.jpg" alt=""></a>

                        </div>
                        <div class="down-content">
                            <span class="category">Action</span>
                            <h4>Assasin Creed</h4>
                            <a href="product-details.html"><i class="fa fa-shopping-bag"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php require_once '../../Layout/Client/footer.php' ?>

    <?php require_once '../../Layout/Client/script.php' ?>

</body>

</html>