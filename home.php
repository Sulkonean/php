<!-- <?php include_once "include/head.php"; ?>
<?php include_once "include/header.php"; ?>

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
                            // Only show products with 'type' => 'home'
                            if (isset($product['type']) && $product['type'] === "home") {
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

<?php include_once "include/head.php"; ?>
<?php include_once "include/header.php"; ?>

<div class="product-section">
    <div class="container">
        <div class="row">

            <!-- Start Column 1: Static Text Section -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">At Target Store.</h2>
                <p class="mb-4">We bring you the latest trends in fashion at unbeatable prices. Whether you're looking for stylish casual wear, elegant formal outfits, or trendy accessories, we have something for everyone. Our collection is carefully curated to ensure top quality, comfort, and style

.</p>
                <p><a href="shop.html" class="btn">Explore</a></p>
            </div> 
            <!-- End Column 1 -->

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
                        // Only show products with 'type' => 'home'
                        if (isset($product['type']) && $product['type'] === "home") {
                            // Ensure the correct image path
                            $imagePath = $imageBasePath . basename($product['image']); 
            ?>
                            <!-- Start Product Column -->
                            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
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
                            <!-- End Product Column -->
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
