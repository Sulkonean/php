<?php
$page = "home.php";
$p = "home";
$hero = true;
$choseus = true;
$help = true;
$pupular = true;
$testnimonimal = false;
$recentblog = true;


if (isset($_GET['p'])) {
    $p = $_GET['p']; // Assign the GET parameter to $p

    switch ($p) {
        case "shop":
            $page = "shop.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "contact":
            $page = "contact.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "cart":
            $page = "cart.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "checkout":
            $page = "checkout.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "about":
            $page = "about.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "services":
            $page = "services.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "blog":
            $page = "blog.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        case "cart":
            $page = "cart.php";
            $hero = false;
            $choseus = false;
            $help = false;
            $pupular = false;
            $testnimonimal = false;
            $recentblog = false;
            break;
        default:
            $page = "home.php"; // Fallback to home if an unknown value is passed
    }
}
?>

<!doctype html>
<html lang="en">

<?php include "include/head.php"; ?>

<body>

    <!-- Start Header/Navigation -->
    <?php include "include/header.php"; ?>
    <!-- End Header/Navigation -->

    <!-- Start Hero Section -->
    <?php if ($hero) include "include/hero.php"; ?>
    <!-- End Hero Section -->

    <!-- Start Product Section -->
    <?php include "$page"; ?>
    <!-- End Product Section -->

    <!-- Start Why Choose Us Section -->
    <?php if ($choseus) include "include/choseus.php"; ?>
    <!-- End Why Choose Us Section -->

    <!-- Start We Help Section -->
    <?php if ($help) include "include/help.php"; ?>
    <!-- End We Help Section -->

    <!-- Start Popular Product -->
    <?php if ($pupular) include "include/popular.php"; ?>
    <!-- End Popular Product -->

    <!-- Start Testimonial Slider -->
    <?php if ($testnimonimal) include "include/testimonimal.php"; ?>
    <!-- End Testimonial Slider -->

    <!-- Start Blog Section -->
    <?php if ($recentblog) include "include/recentblog.php"; ?>
    <!-- End Blog Section -->

    <!-- Start Footer Section -->
    <?php include_once "include/footer.php"; ?>
    <!-- End Footer Section -->

    <?php include_once "include/script.php"; ?>
</body>

</html>