<!-- <?php
// Database connection (same as in the previous code)
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

// Fetch all products
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
                        <h1 class="h3 mb-0 text-gray-800">Product List</h1>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 mb-4">
                            <div class="card">
                                <div class="card-header text-primary font-weight-bold">Product List</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
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
                                                    <td><?php echo $product['name']; ?></td>
                                                    <td><?php echo $product['price']; ?></td>
                                                    <td><?php echo $product['status']; ?></td>
                                                    <td><?php echo $product['type']; ?></td>
                                                    <td><img src="<?php echo $product['image']; ?>" width="50"></td>
                                                    <td>
                                                        <a href="edit.php?id=<?php echo $product['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
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
</html> -->
