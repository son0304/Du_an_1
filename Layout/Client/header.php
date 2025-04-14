<header class="header-area header-sticky text-white py-3 ">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">

            <!-- Logo -->
            <h1 class="m-0 text-white">Sweet_Cake</h1>

            <!-- Navigation Menu -->
            <ul class="d-flex list-unstyled gap-4 m-0">
                <li><a href="index.html" class="text-white text-decoration-none">Home</a></li>
                <li><a href="?action=product" class="text-white text-decoration-none">Product</a></li>
                <li><a href="?action=listOrder" class="text-white text-decoration-none">Order</a></li>
                <li><a href="contact.html" class="text-white text-decoration-none">Contact Us</a></li>
            </ul>

            <!-- Cart & Sign In -->
            <div class="d-flex align-items-center gap-5">
                <a href="?action=cart" class="text-white position-relative mt-1">
                    <i class="fas fa-shopping-cart fa-lg"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
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