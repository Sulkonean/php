<?php include_once "include/head.php"; ?>
<?php include_once "include/header.php"; ?>

<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <!-- <h1>Shop</h1> -->
                    <h1>Shop, Your Ultimate Fashion Destination!</h1>
                    <p><a href="#"
                    class="btn btn-white-outline">Explore</a></p>

                </div>
            </div>
            <div class="col-lg-7">
            <div class="hero-img-wrap">
					<img src="images/hero2.png" class="img-fluid">
				</div>
            </div>
        </div>
    </div>
</div>

<div class="product-section">
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                <?php
                // Define correct base URL for images
                $imageBasePath = "http://localhost:8888/duo/admin/uploads/";

                // Load and decode the JSON file
                $jsonFile = "admin/json_files/products.json";
                if (file_exists($jsonFile)) {
                    $jsonData = file_get_contents($jsonFile);
                    $products = json_decode($jsonData, true);

                    if ($products) {
                        foreach ($products as $product) {
                            // Ensure the correct image path
                            $imagePath = $imageBasePath . basename($product['image']); // Use only the filename
                ?>
                            <div class="col-12 col-md-4 col-lg-3 mb-5">
                                <a class="product-item" href="#">
                                    <img src="<?php echo $imagePath; ?>" class="img-fluid product-thumbnail" alt="<?php echo $product['name']; ?>">
                                    <h3 class="product-title"><?php echo $product['name']; ?></h3>
                                    <strong class="product-price">$<?php echo $product['price']; ?></strong>

                                    <span class="icon-cross">
                                        <img src="images/cross.svg" class="img-fluid">
                                    </span>

                                    <?php if ($product['status'] === "Out of Stock") { ?>
                                        <p class="text-danger">Out of Stock</p>
                                    <?php } ?>
                                </a>
                            </div>
                <?php
                        }
                    } else {
                        echo "<p>No products available</p>";
                    }
                } else {
                    echo "<p>Product file not found.</p>";
                }
                ?>


            </div>
        </div>
    </div>
</div>
<!-- <div class="product-section">
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                <?php
                // Define correct base URL for images
                $imageBasePath = "http://localhost:8888/duo/admin/uploads/";

                // Load and decode the JSON file
                $jsonFile = "admin/json_files/products.json";
                if (file_exists($jsonFile)) {
                    $jsonData = file_get_contents($jsonFile);
                    $products = json_decode($jsonData, true);

                    if ($products) {
                        foreach ($products as $product) {
                            // Filter by product type (show only 'shop' type)
                            if ($product['type'] === 'shop') {
                                // Ensure the correct image path
                                $imagePath = $imageBasePath . basename($product['image']); // Use only the filename
                ?>
                                <div class="col-12 col-md-4 col-lg-3 mb-5">
                                    <a class="product-item" href="#">
                                        <img src="<?php echo $imagePath; ?>" class="img-fluid product-thumbnail" alt="<?php echo $product['name']; ?>">
                                        <h3 class="product-title"><?php echo $product['name']; ?></h3>
                                        <strong class="product-price">$<?php echo $product['price']; ?></strong>

                                        <span class="icon-cross">
                                            <img src="images/cross.svg" class="img-fluid">
                                        </span>

                                        <?php if ($product['status'] === "Out of Stock") { ?>
                                            <p class="text-danger">Out of Stock</p>
                                        <?php } ?>
                                    </a>
                                </div>
                <?php
                            }
                        }
                    } else {
                        echo "<p>No products available</p>";
                    }
                } else {
                    echo "<p>Product file not found.</p>";
                }
                ?>


            </div>
        </div>
    </div>
</div> -->


<?php include "include/footer.php"; ?>
<?php include "include/script.php"; ?>