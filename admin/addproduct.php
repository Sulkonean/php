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

// Initialize product insertion and update flags
$productInserted = false;
$productUpdated = false;
$productToEdit = null;

// JSON file path
$jsonFile = 'json_files/products.json';

// Create json_files directory if not exists
if (!is_dir('json_files')) {
    mkdir('json_files', 0777, true);
}

// Handle adding a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $status = $_POST['status'];
    $type = $_POST['type'];  // Shop/Home
    $imagePath = null;

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Check for allowed file types (JPG, PNG, GIF)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES["image"]["tmp_name"]);

        if (!in_array($fileType, $allowedTypes)) {
            echo "<div class='alert alert-danger'>Invalid file type. Only JPG, PNG, and GIF are allowed.</div>";
        } else {
            $imageName = time() . "_" . basename($_FILES["image"]["name"]);
            $imageDir = 'uploads/';
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }
            $imagePath = $imageDir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        }
    }

    // Insert into database
    $stmt = $pdo->prepare("INSERT INTO products (name, price, status, type, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $price, $status, $type, $imagePath]);

    // Save to JSON file
    $productData = ['name' => $name, 'price' => $price, 'status' => $status, 'type' => $type, 'image' => $imagePath];
    $existingData = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
    $existingData[] = $productData;
    file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));

    $productInserted = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle product editing
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];

    // Get product info to pre-fill the form
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$editId]);
    $productToEdit = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Handle updating a product
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $imagePath = $_POST['current_image']; // Preserve current image if not updating

    // Handle image upload for editing
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Check for allowed file types (JPG, PNG, GIF)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES["image"]["tmp_name"]);

        if (!in_array($fileType, $allowedTypes)) {
            echo "<div class='alert alert-danger'>Invalid file type. Only JPG, PNG, and GIF are allowed.</div>";
        } else {
            $imageName = time() . "_" . basename($_FILES["image"]["name"]);
            $imageDir = 'uploads/';
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0777, true);
            }
            $imagePath = $imageDir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);

            // Remove old image if a new one is uploaded
            if (!empty($_POST['current_image']) && file_exists($_POST['current_image'])) {
                unlink($_POST['current_image']);
            }
        }
    }

    // Update database
    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ?, status = ?, type = ?, image = ? WHERE id = ?");
    $stmt->execute([$name, $price, $status, $type, $imagePath, $id]);

    // Update JSON file
    if (file_exists($jsonFile)) {
        $existingData = json_decode(file_get_contents($jsonFile), true);
        foreach ($existingData as &$product) {
            if ($product['id'] == $id) {
                $product['name'] = $name;
                $product['price'] = $price;
                $product['status'] = $status;
                $product['type'] = $type;
                $product['image'] = $imagePath;
                break;
            }
        }
        file_put_contents($jsonFile, json_encode($existingData, JSON_PRETTY_PRINT));
    }

    $productUpdated = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Handle product deletion
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
        if (file_exists($jsonFile)) {
            $existingData = json_decode(file_get_contents($jsonFile), true);
            $filteredData = array_filter($existingData, fn($item) => $item['name'] !== $product['name']);
            file_put_contents($jsonFile, json_encode(array_values($filteredData), JSON_PRETTY_PRINT));
        }
    }
}

// Fetch products from database (show both shop and home products)
$stmt = $pdo->query("SELECT * FROM products WHERE type IN ('shop', 'home') ORDER BY id DESC");
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
                        <h1 class="h3 mb-0 text-gray-800">Add, Edit & Display Products</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="card">
                                <div class="card-header text-primary font-weight-bold"><?php echo isset($productToEdit) ? 'Edit' : 'Add'; ?> Product</div>
                                <div class="card-body">
                                    <?php if ($productInserted): ?>
                                        <div class="alert alert-success">Product added successfully!</div>
                                    <?php elseif ($productUpdated): ?>
                                        <div class="alert alert-success">Product updated successfully!</div>
                                    <?php endif; ?>

                                    <form method="POST" enctype="multipart/form-data">
                                        <?php if (isset($productToEdit)): ?>
                                            <input type="hidden" name="id" value="<?php echo $productToEdit['id']; ?>">
                                            <input type="hidden" name="current_image" value="<?php echo $productToEdit['image']; ?>">
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label>Product Name</label>
                                            <input type="text" name="name" class="form-control" value="<?php echo isset($productToEdit) ? $productToEdit['name'] : ''; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Price ($)</label>
                                            <input type="number" step="0.01" name="price" class="form-control" value="<?php echo isset($productToEdit) ? $productToEdit['price'] : ''; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control" required>
                                                <option value="Available" <?php echo isset($productToEdit) && $productToEdit['status'] == 'Available' ? 'selected' : ''; ?>>Available</option>
                                                <option value="Out of Stock" <?php echo isset($productToEdit) && $productToEdit['status'] == 'Out of Stock' ? 'selected' : ''; ?>>Out of Stock</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Upload To</label>
                                            <select name="type" class="form-control" required>
                                                <option value="shop" <?php echo isset($productToEdit) && $productToEdit['type'] == 'shop' ? 'selected' : ''; ?>>Shop</option>
                                                <option value="home" <?php echo isset($productToEdit) && $productToEdit['type'] == 'home' ? 'selected' : ''; ?>>Home</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" name="image" class="form-control">
                                            <?php if (isset($productToEdit) && $productToEdit['image']): ?>
                                                <img src="<?php echo $productToEdit['image']; ?>" alt="Product Image" width="100" class="mt-2">
                                            <?php endif; ?>
                                        </div>
                                        <button type="submit" name="<?php echo isset($productToEdit) ? 'update_product' : 'add_product'; ?>" class="btn btn-primary"><?php echo isset($productToEdit) ? 'Update' : 'Add'; ?> Product</button>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Display Products -->
                        <div class="col-lg-12 mb-4">
    <div class="card">
        <div class="card-header text-primary font-weight-bold">Product List</div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td><?php echo $product['status']; ?></td>
                            <td><?php echo $product['type']; ?></td>
                            <td><img src="<?php echo $product['image']; ?>" width="50"></td>
                            <td>
                                <a href="?edit_id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <form method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this product?');">
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

    <?php include_once "include/footer.php"; ?>
</body>
</html>
