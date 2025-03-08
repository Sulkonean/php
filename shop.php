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
        setTimeout(() => notification.remove(), 200);
    }, 3000);
}
</script>
<style>
    /* Custom notification styles */
.custom-alert {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color:rgb(126, 181, 97);
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
    opacity: 0.5;
    transform: translateY(0);
}

</style>



    <!-- <script>
        document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".add-to-cart").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            let product = this.closest(".product-item"); // Adjust based on your HTML structure
            let productId = product.dataset.id;
            let productName = product.querySelector(".product-name").textContent;
            let productPrice = product.querySelector(".product-price").textContent.replace("$", "").trim();
            let productImage = product.querySelector(".product-image").src;
            let productQuantity = 1; // Default to 1

            console.log("Product ID:", productId); // Debugging

            if (!productId) {
                alert("Error: Product ID is missing!");
                return;
            }

            let formData = new FormData();
            formData.append("action", "add");
            formData.append("product_id", productId);
            formData.append("name", productName);
            formData.append("price", productPrice);
            formData.append("image", productImage);
            formData.append("quantity", productQuantity);

            fetch("cart_action.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log("Response:", data); // Debugging
                if (data.success) {
                    alert("Product added to cart!");
                } else {
                    alert(data.error || "Error adding product!");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    });
});

    </script> -->
                <!-- <script>fetch("cart_action.php", {
    method: "POST",
    body: new FormData(document.querySelector("#add-to-cart-form")),
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        window.location.href = "index.php?p=cart"; // Redirect to cart page
    } else {
        alert(data.error);
    }
}); -->
<!-- </script> -->
</div>

<?php include "include/footer.php"; ?>
<?php include "include/script.php"; ?>
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