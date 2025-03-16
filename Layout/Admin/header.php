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
                        <a href="dashboard.php?action=index">
                            <i class="fa-solid fa-house"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="dashboard.php?action=users">
                            <i class="fa-solid fa-users"></i> Users
                        </a>
                    </li>
                    <li class="has-submenu">
                        <a href="#">
                            <i class="fa-solid fa-list"></i> Products
                        </a>
                        <ul class="submenu">
                            <li><a href="dashboard.php?action=product_list">List</a></li>
                            <li><a href="dashboard.php?action=product_categories">Categories</a></li>
                            <li><a href="dashboard.php?action=product_size">Size</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="dashboard.php?action=settings">
                            <i class="fa-solid fa-gears"></i> Setting
                        </a>
                    </li>
                </ul>
            </div>
        </article>
        <aside>