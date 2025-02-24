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


<!-- use -->
<!-- <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
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
</nav> -->

<!-- <?php session_start(); ?> -->
<?php 
$current_page = basename($_SERVER['PHP_SELF']); 
?>

<nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" aria-label="Furni navigation bar">
    <div class="container">
        <a class="navbar-brand" href="index.php">Target Store<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <!-- <li class="nav-item <?= ($current_page == 'index.php' || !isset($_GET['p'])) ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?=home">Home</a>
                </li> -->
                <li class="nav-item <?= ($current_page == 'index.php' && isset($_GET['p']) && $_GET['p'] == 'home') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=home">Home</a>
                </li>
                <li class="nav-item <?= ($current_page == 'index.php' && isset($_GET['p']) && $_GET['p'] == 'shop') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=shop">Shop</a>
                </li>
                <li class="nav-item <?= ($current_page == 'index.php' && isset($_GET['p']) && $_GET['p'] == 'about') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=about">About Us</a>
                </li>
                <li class="nav-item <?= ($current_page == 'index.php' && isset($_GET['p']) && $_GET['p'] == 'services') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=services">Services</a>
                </li>
                <li class="nav-item <?= ($current_page == 'index.php' && isset($_GET['p']) && $_GET['p'] == 'blog') ? 'active' : '' ?>">
                    <a class="nav-link" href="index.php?p=blog">Blog</a>
                </li>
                <li class="nav-item <?= ($current_page == 'index.php' && isset($_GET['p']) && $_GET['p'] == 'contact') ? 'active' : '' ?>">
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
    <a class="nav-link" href="cart.php">
        <img src="images/cart.svg" alt="Cart" class="navbar-icon">
        <span id="cart-count" class="badge bg-danger">
            <?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?>
        </span>
    </a>
</li>


            </ul>
        </div>
    </div>
</nav>

<?php
if (session_status() === PHP_SESSION_NONE) {
    // session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $product_id = $_POST['id'] ?? '';

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($action === 'increase' && isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } elseif ($action === 'decrease' && isset($_SESSION['cart'][$product_id])) {
        if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
            $_SESSION['cart'][$product_id]['quantity']--;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    } elseif ($action === 'remove') {
        unset($_SESSION['cart'][$product_id]);
    }

    // Calculate updated cart count
    $cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;

    echo json_encode(['success' => true, 'cart_count' => $cart_count]);
    exit;
}
?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    function updateCartCount() {
        fetch("cart_count.php")
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById("cart-count");
                if (cartCountElement) {
                    cartCountElement.textContent = data.cart_count;
                }
            })
            .catch(error => console.error("Error fetching cart count:", error));
    }

    updateCartCount(); // Call function on page load

    // Optional: Refresh cart count every 5 seconds
    setInterval(updateCartCount, 1000);
});
</script>


