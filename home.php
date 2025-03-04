<?php include_once "include/head.php"; ?>
<?php include_once "include/header.php"; ?>

<div class="product-section">
    <div class="container">
        <div class="row">

            <!-- Start Column 1: Static Text Section -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">At Target Store.</h2>
                <p class="mb-4">
                    We bring you the latest trends in fashion at unbeatable prices. Whether you're looking for stylish casual wear, elegant formal outfits, or trendy accessories, we have something for everyone. 
                </p>
                <p><a href="shop.php" class="btn">Explore</a></p>
            </div> 
            <!-- End Column 1 -->

            <?php
            // Define base URL for product images
            $imageBasePath = "http://localhost:8888/duo/admin/uploads/";

            // Load and decode JSON file
            $jsonFile = "admin/json_files/products.json";
            if (file_exists($jsonFile)) {
                $jsonData = file_get_contents($jsonFile);
                $products = json_decode($jsonData, true);

                if ($products) {
                    foreach ($products as $product) {
                        // Only display products with 'type' => 'home'
                        if (isset($product['type']) && $product['type'] === "home") {
                            $imagePath = $imageBasePath . basename($product['image']);
            ?>
                            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                                <a class="product-item" href="#">
                                    <img src="<?php echo $imagePath; ?>" class="img-fluid product-thumbnail" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                    <h3 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h3>
                                    <strong class="product-price">$<?php echo htmlspecialchars($product['price']); ?></strong>

                                    <!-- Add to Cart Form -->
                                    <form method="post" action="cart_action.php">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" name="name" value="<?= htmlspecialchars($product['name'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" name="price" value="<?= htmlspecialchars($product['price'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" name="image" value="<?= htmlspecialchars($imagePath, ENT_QUOTES, 'UTF-8'); ?>">
                                        <input type="hidden" name="quantity" value="1">

                                        <?php if (!empty($product['id'])) { ?>
                                            <button type="submit" class="icon-cross add-to-cart" data-id="<?= htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <img src="images/cross.svg" class="img-fluid" alt="Add to cart">
                                            </button>
                                        <?php } else { ?>
                                            <p class="text-danger">Error: Product ID missing.</p>
                                        <?php } ?>
                                    </form>

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

<!-- JavaScript for AJAX Add to Cart -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            let form = this.closest("form");
            let formData = new FormData(form);

            fetch("cart_action.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json()) // Convert response to JSON
            .then(data => {
                if (data.success) {
                    // Show custom notification
                    showNotification(`✅ Product added! Total Quantity: ${data.quantity}`);
                } else {
                    showNotification(`❌ Error: ${data.error || "Could not add product!"}`);
                }
            })
            .catch(error => {
                console.error("Error:", error);
                showNotification("❌ Something went wrong!");
            });
        });
    });
});

// Function to show a custom notification with animation
function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'custom-alert';
    notification.textContent = message;

    document.body.appendChild(notification);

    // Add fade-in animation
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);

    // Remove notification after 3 seconds with fade-out animation
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}
</script>

<!-- CSS for Custom Notifications -->
<style>
/* Custom notification styles */
.custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: rgb(126, 181, 97);
    color: #fff;
    padding: 15px 20px;
    border-radius: 8px;
    opacity: 0;
    transform: translateY(-20px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    z-index: 1000;
    box-shadow: 0 4px 6px rgba(19, 238, 77, 0.1);
    font-size: 16px;
    font-weight: bold;
}

/* Show animation */
.custom-alert.show {
    opacity: 1;
    transform: translateY(0);
}
</style>
