<?php
// Start output buffering
ob_start();
session_start();

// Database Connection (Using PDO)
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

// Initialize product insertion flag
$productInserted = false;

// Insert Product into Database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $status = $_POST['status'];

    // Handle image upload
    $imagePath = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);
        $fileExtension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

        if (in_array($fileType, $allowedTypes) && in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            $imageDir = 'uploads/';
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }
            $imagePath = $imageDir . $imageName;

            if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $imagePath = null; // Reset if upload fails
            }
        }
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO products (name, price, status, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $price, $status, $imagePath]);

    // Save to JSON file
    $productData = ['name' => $name, 'price' => $price, 'status' => $status, 'image' => $imagePath];

    $jsonDir = 'json_files';
    if (!is_dir($jsonDir)) {
        mkdir($jsonDir, 0777, true);
    }

    $jsonFile = $jsonDir . '/products.json';
    $existingData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
    $existingData[] = $productData;
    file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));

    $productInserted = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Delete Product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $deleteId = $_POST['delete_id'];

    // Get product info
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$deleteId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Delete image file if exists
        if (!empty($product['image']) && file_exists($product['image'])) {
            unlink($product['image']);
        }

        // Delete from database
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$deleteId]);

        // Update JSON file
        $jsonFile = 'json_files/products.json';
        if (file_exists($jsonFile)) {
            $existingData = json_decode(file_get_contents($jsonFile), true);
            $filteredData = array_filter($existingData, fn($item) => $item['name'] !== $product['name']);
            file_put_contents($jsonFile, json_encode(array_values($filteredData), JSON_PRETTY_PRINT));
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// Fetch Products
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                        <h1 class="h3 mb-0 text-gray-800">Add & Display Products</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header text-primary font-weight-bold">Add Product</div>
                                <div class="card-body">
                                    <?php if ($productInserted): ?>
                                        <div class="alert alert-success">Product added successfully!</div>
                                    <?php endif; ?>
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Price ($)</label>
                                            <input type="number" step="0.01" name="price" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="Available">Available</option>
                                                <option value="Out of Stock">Out of Stock</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                        <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header text-primary font-weight-bold">Product List</div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Price ($)</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $product): ?>
                                                <tr>
                                                    <td><?php echo $product['id']; ?></td>
                                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                                    <td><?php echo $product['price']; ?></td>
                                                    <td>
                                                        <span class="badge <?php echo $product['status'] == 'Available' ? 'badge-success' : 'badge-danger'; ?>">
                                                            <?php echo $product['status']; ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <?php if ($product['image']): ?>
                                                            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" width="100">
                                                        <?php else: ?>
                                                            No image available
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <form method="POST">
                                                            <input type="hidden" name="delete_id" value="<?php echo $product['id']; ?>">
                                                            <button type="submit" name="delete_product" class="btn btn-danger btn-sm">Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "include/scriptandscrollontop.php"; ?>
</body>
</html>

<?php ob_end_flush(); ?>
