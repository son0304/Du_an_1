<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php?action=home">
        <div class="sidebar-brand-icon ">
            <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="../../Assets/image/products/Sweet Cake.jpg" width="50px" height="50px" style="border-radius: 40px;">
        </div>
        <div class="sidebar-brand-text mx-3">SC Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard.php?action=home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="dashboard.php?action=users">
            <i class=" fas fa-solid fa-users"></i>
            <span>Users</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="dashboard.php?action=orders">
            <i class="fas fa-receipt"></i>
            <span>Orders</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-birthday-cake"></i>
            <span>Products</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="dashboard.php?action=categories">Category</a>
                <a class="collapse-item" href="dashboard.php?action=product">Product</a>

            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="dashboard.php?action=settings">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Settings</span></a>
    </li>

    <!-- Nav Item - Logout -->
    <li class="nav-item mt-2">
        <a class="nav-link d-flex align-items-center ml-1 my-4" href="http://localhost/Du_an_1/View/Auth/logout.php">
            <i class="fas fa-sign-out-alt fs-6 me-2"></i>
            <span class="fs-6">Logout</span>
        </a>

    </li>
</ul>