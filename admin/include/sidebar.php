<ul class="navbar-nav sidebar sidebar-light bg-dark accordion" id="accordionSidebar">
    <!-- Brand Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?p=home">
        <div class="sidebar-brand-icon">
            <img src="img/logo.jpg" width="40">
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item <?= ($p == 'home') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?p=home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Features Section -->
    <div class="sidebar-heading">Features</div>

    <!-- <li class="nav-item <?= ($p == 'forms') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm">
            <i class="fab fa-fw fa-wpforms"></i>
            <span>Forms</span>
        </a>
        <div id="collapseForm" class="collapse <?= ($p == 'form_basics' || $p == 'form_advanceds') ? 'show' : '' ?>">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Form Options</h6>
                <a class="collapse-item <?= ($p == 'form_basics') ? 'active' : '' ?>" href="index.php?p=form_basics">Basic Forms</a>
                <a class="collapse-item <?= ($p == 'form_advanceds') ? 'active' : '' ?>" href="index.php?p=form_advanceds">Advanced Forms</a>
            </div>
        </div>
    </li> -->

    <li class="nav-item <?= ($p == 'tables') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Category</span>
        </a>
        <div id="collapseTable" class="collapse <?= ($p == 'addproduct' || $p == 'datatables') ? 'show' : '' ?>">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category</h6>
                <a class="collapse-item <?= ($p == 'addproduct') ? 'active' : '' ?>" href="index.php?p=addproduct">Product</a>
                <!-- <a class="collapse-item <?= ($p == 'datatables') ? 'active' : '' ?>" href="index.php?p=datatables">DataTables</a> -->
            </div>
        </div>
    </li>

    <!-- <li class="nav-item <?= ($p == 'ui-colors') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?p=ui-colors">
            <i class="fas fa-fw fa-palette"></i>
            <span>UI Colors</span>
        </a>
    </li> -->

    <hr class="sidebar-divider">

    <!-- Pages Section -->
    <div class="sidebar-heading">Pages</div>

    <li class="nav-item <?= ($p == 'pages') ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePage">
            <i class="fas fa-fw fa-columns"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePage" class="collapse <?= ($p == 'login' || $p == 'register' || $p == '404' || $p == 'blank') ? 'show' : '' ?>">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Example Pages</h6>
                <a class="collapse-item <?= ($p == 'login') ? 'active' : '' ?>" href="index.php?p=login">Login</a>
                <a class="collapse-item <?= ($p == 'register') ? 'active' : '' ?>" href="index.php?p=register">Register</a>
                <a class="collapse-item <?= ($p == '404') ? 'active' : '' ?>" href="index.php?p=404">404 Page</a>
                <!-- <a class="collapse-item <?= ($p == 'blank') ? 'active' : '' ?>" href="index.php?p=blank">Blank Page</a> -->
            </div>
        </div>
    </li>

    <!-- <li class="nav-item <?= ($p == 'charts') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php?p=charts">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span>
        </a>
    </li> -->

    <hr class="sidebar-divider">
</ul>
