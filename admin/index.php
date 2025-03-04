

<?php
session_start();
ob_start(); // Start output buffering to prevent "headers already sent" issues

// Check if the user is logged in, redirect to login page if not
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$page = "home.php";
$p = "home";

if (isset($_GET['p'])) {
    $p = basename($_GET['p']); // Sanitize the input to avoid security risks

    switch ($p) {
        case "addproduct":
            $page = "addproduct.php";
            break;
        default:
            $page = "home.php"; // Fallback to home if an unknown value is passed
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <?php include "include/sidebar.php"; ?>
    <!-- Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <?php include "include/topbar.php"; ?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <?php include $page; ?> <!-- Dynamically include the page based on $page -->
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
      <?php include "include/footer.php"; ?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <?php include "include/scriptandscrollontop.php"; ?>

  <?php ob_end_flush(); // Flush the buffer at the end to prevent issues ?>
</body>
</html>
