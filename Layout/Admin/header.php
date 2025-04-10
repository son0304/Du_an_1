<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL__CSS ?>home.css">
</head>

<body>
    <header>
        <h1>Galaxy Shop</h1>
    </header>
    <main>
        <article class="sidebar">
            <div>
                <ul>
                    <div class="dashboard">
                        <i class="fa-solid fa-circle-user"></i>
                        <a href="#">Admin</a>
                    </div>
                </ul>
                <ul class="menu">
                    <li>
                        <i class="fa-solid fa-house"></i>
                        <a href="dashboard.php?action=index">Home</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-users"></i>
                        <a href="dashboard.php?action=users">Users</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-bars"></i>
                        <a href="dashboard.php?action=product">Products</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-cart-shopping"></i>
                        <a href="dashboard.php?action=orders">Orders</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-gears"></i>
                        <a href="dashboard.php?action=settings">Setting</a>
                    </li>
                </ul>
            </div>
        </article>
        <aside>