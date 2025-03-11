<?php require_once '../../Config/config.php'  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="<?=ADMIN_URL__CSS?>home.css">
</head>

<body>
    <header>
        <h1> Galaxy Shop </h1>
    </header>
    <main>
        <!-- SideBar -->
        <article class="sidebar">
            <div>

                <ul>
                    <div class="dashboard">
                        <i class="fa-solid fa-circle-user"></i>
                        <a href="">Admin</a>
                    </div>
                </ul>
                <ul class=" menu">
                    <li>
                        <i class="fa-solid fa-house"></i>
                        <a href="">Home</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-users"></i>
                        <a href="">Users</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-diagram-project"></i>
                        <a href=""> Project</a>
                    </li>
                    <li>
                        <i class="fa-solid fa-gears"></i>
                        <a href=""> Setting</a>
                    </li>
                </ul>
            </div>
        </article>

        <aside>
            <h1>Đây là content</h1>
        </aside>
    </main>

    <footer>
        <p>Le@Van@son</p>
    </footer>
</body>

</html>