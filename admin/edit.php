<!-- <?php
// Start session and output buffering
session_start();
ob_start();

// Database connection
$dsn = "mysql:host=localhost;dbname=product_db;charset=utf8mb4";
$username = "root";
$password = "root";

try {
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if product ID is provided in the URL for editing
if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Product ID is missing.</div>";
    exit;
}

$productId = $_GET['id'];

// Fetch the product to edit
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "<div class='alert alert-danger'>Product not found.</div>";
    exit;
}

// Handle product update when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $imagePath = $_POST['current_image'];  // Preserve the existing image

    // Handle image upload if a new image is selected
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Validate the image file type (JPG, PNG, GIF)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES["image"]["tmp_name"]);

        if (!in_array($fileType, $allowedTypes)) {
            echo "<div class='alert alert-danger'>Invalid file type. Only JPG, PNG, and GIF are allowed.</div>";
        } else {
            // Generate a new file name and save the uploaded image
            $imageName = time() . "_" . basename($_FILES["image"]["name"]);
            $imageDir = 'uploads/';
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }
            $imagePath = $imageDir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

            // Remove the old image if it's not the default one
            if (!empty($_POST['current_image']) && file_exists($_POST['current_image'])) {
                unlink($_POST['current_image']);
            }
        }
    }

    // Update the product in the database
    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, status = ?, type = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $price, $status, $type, $imagePath, $productId]);

    // Redirect back to the product list after updating
    header("Location: product_list.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include_once "include/head.php"; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include_once "include/sidebar.php"; ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include_once "include/topbar.php"; ?>

                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header text-primary font-weight-bold">Edit Product</div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="current_image" value="<?php echo $product['image']; ?>">

                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control" value="<?php echo $product['name']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Price ($)</label>
                                            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo $product['price']; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="Available" <?php echo $product['status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                                <option value="Out of Stock" <?php echo $product['status'] == 'Out of Stock' ? 'selected' : ''; ?>>Out of Stock</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Type</label>
                                            <select name="type" class="form-control" required>
                                                <option value="shop" <?php echo $product['type'] == 'shop' ? 'selected' : ''; ?>>Shop</option>
                                                <option value="home" <?php echo $product['type'] == 'home' ? 'selected' : ''; ?>>Home</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <?php if (!empty($product['image'])): ?>
                                                <img src="<?php echo $product['image']; ?>" alt="Product Image" width="100" class="mt-2">
                                            <?php endif; ?>
                                        </div>

                                        <button type="submit" name="update_product" class="btn btn-primary">Update Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "include/footer.php"; ?>
</body>
</html> -->
