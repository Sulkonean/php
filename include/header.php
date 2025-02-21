<!-- <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

<div class="container">
    <a class="navbar-brand" href="index.html">Furni<span>.</span></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsFurni">
        <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li><a class="nav-link" href="index.php?p=shop">Shop</a></li>
            <li><a class="nav-link" href="index.php?p=contact">Contact us</a></li>
        </ul>

        <ul class="custom-navbar-c ta navbar-nav mb-2 mb-md-0 ms-5">
            <li><a class="nav-link" href="#"><img src="images/user.svg"></a></li>
            <li><a class="nav-link" href="cart.html"><img src="images/cart.svg"></a></li>
        </ul>
    </div>
</div>
    
</nav> -->



<!-- second -->
<!-- <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="index.php">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <?php
                $p = isset($_GET['p']) ? $_GET['p'] : 'home';
                ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'home') ? 'active' : '' ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'shop') ? 'active' : '' ?>" href="index.php?p=shop">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'contact') ? 'active' : '' ?>" href="index.php?p=contact">Contact Us</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a class="nav-link" href="#"><img src="images/user.svg" alt="User"></a></li>
                <li class="nav-item">

                <li><a class="nav-link" href="index.php?p=cart"><img src="images/cart.svg" alt="Cart"></a></li>
                </li>
                <li class="nav-item">

                <li><a class="nav-link" href="index.php?p=checkout"><img src="images/cart.svg" alt="Checkout"></a></li>
                </li>
            </ul>
        </div>
    </div>

</nav> -->

<!-- testing third -->
<!-- <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="index.php">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <?php
                $p = isset($_GET['p']) ? $_GET['p'] : 'home';
                ?>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'home' || !isset($_GET['p'])) ? 'active' : '' ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'shop') ? 'active' : '' ?>" href="index.php?p=shop">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'contact') ? 'active' : '' ?>" href="index.php?p=contact">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($p == 'checkout') ? 'active' : '' ?>" href="index.php?p=checkout">ChackOut</a>
                </li> -->
            <!-- </ul>

            <ul class="custom-navbar-cta navbar-nav mb-0 ms-5">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="images/user.svg" alt="User" class="navbar-icon">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?p=cart">
                        <img src="images/cart.svg" alt="Cart" class="navbar-icon">
                    </a>
                </li>
            </ul>

        </div>
    </div>

</nav> -->

<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="index.php">Target Store<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <?php $p = isset($_GET['p']) ? $_GET['p'] : 'home'; ?>

            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item <?= ($p == 'home') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item <?= ($p == 'shop') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=shop">Shop</a>
                </li>
                <li class="nav-item <?= ($p == 'about') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=about">About US</a>
                </li>
                <li class="nav-item <?= ($p == 'services') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=services">Services</a>
                </li>
                <li class="nav-item <?= ($p == 'blog') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=blog">Blog</a>
                </li>
                <li class="nav-item <?= ($p == 'contact') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=contact">Contact Us</a>
                </li>
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-0 ms-5">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <img src="images/user.svg" alt="User" class="navbar-icon">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?p=cart">
                        <img src="images/cart.svg" alt="Cart" class="navbar-icon">
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

