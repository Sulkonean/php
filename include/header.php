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
<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">

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
                <li><a class="nav-link" href="cart.html"><img src="images/cart.svg" alt="Cart"></a></li>
            </ul>
        </div>
    </div>

</nav>
