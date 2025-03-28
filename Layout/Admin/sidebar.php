<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-2">
        <div class="sidebar-brand-icon">
            <i class="fas fa-laugh-wink fs-3"></i> <!-- Icon to hơn -->
        </div>
        <div class="sidebar-brand-text mx-3 fs-6"><?php echo $_SESSION['user']['name']?></div> <!-- Chữ to hơn -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link d-flex align-items-center" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt fs-6 me-2"></i>
            <span class="fs-6">Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->


    <!-- Nav Item - User -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="dashboard.php?action=users">
            <i class="fas fa-users fs-6 me-2"></i>
            <span class="fs-6">User</span>
        </a>
    </li>

    <!-- Nav Item - Order -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center ml-1" href="dashboard.php?action=orders">
            <i class="fas fa-receipt fs-6 me-2"></i>
            <span class="fs-6">Order</span>
        </a>
    </li>

    <!-- Nav Item - Products (Dropdown) -->
    <li class="nav-item">
        <a class="nav-link collapsed d-flex align-items-center " href="#" data-toggle="collapse" data-target="#collapseProducts"
            aria-expanded="false" aria-controls="collapseProducts">
            <i class="fas fa-fw fa-wrench fs-6 me-2"></i>
            <span class="fs-6">Products</span>
        </a>
        <div id="collapseProducts" class="collapse" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item fs-6" href="dashboard.php?action=categories">Category</a>
                <a class="collapse-item fs-6" href="dashboard.php?action=product">Product</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link d-flex align-items-center" href="tables.html">
            <i class="fas fa-fw fa-table fs-6 me-2"></i>
            <span class="fs-6">Tables</span>
        </a>
    </li>

    <!-- Nav Item - Logout -->
    <li class="nav-item mt-2">
        <a class="nav-link d-flex align-items-center ml-1 my-4" href="http://localhost/Du_an_2/View/Auth/logout.php">
            <i class="fas fa-sign-out-alt fs-6 me-2"></i>
            <span class="fs-6">Logout</span>
        </a>

    </li>

</ul>