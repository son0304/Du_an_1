<?php require_once '../../Config/config.php'  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="styles.css"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?=CLIENT_URL_CSS?>homeClient.css">

</head>

<body>
    <nav>
        <ul class="logo">
            <h1>Galaxy Shop</h1>
        </ul>
        <ul class="menu">
            <li>
                <i class="fa-solid fa-house"></i>
                <a href="">Home</a>
            </li>
            <li>
                <i class="fa-solid fa-address-card"></i>
                <a href="">About</a>
            </li>
            <li>
                <i class="fa-solid fa-address-book"></i>
                <a href="">Contact </a>
            </li>
            <li>
                <i class="fa-solid fa-square-rss"></i>
                <a href="">Blog</a>
            </li>
        </ul>
        <ul class="cart">
            <li><i class="fa-solid fa-cart-shopping"></i></li>
            <li>
                <i class="fa-solid fa-circle-user"></i> <br>
                <a href="">user</a>
            </li>

        </ul>
    </nav>
    <header></header>
    <main>
        <section>
            <h1>Section 1 </h1>
            <div class="container">
                <div class="product"></div>
                <div class="product"></div>
                <div class="product"></div>
                <div class="product"></div>
            </div>

        </section>

        <section>
            <h1>Section 1 </h1>
            <div class="container">
                <div class="product"></div>
                <div class="product"></div>
                <div class="product"></div>
                <div class="product"></div>
            </div>

        </section>
        <section>
            <h1>Section 1 </h1>
            <div class="container">
                <div class="product"></div>
                <div class="product"></div>
                <div class="product"></div>
                <div class="product"></div>
            </div>

        </section>
    </main>
    <footer>
        <p>Le@Van@son</p>
    </footer>
</body>

</html>