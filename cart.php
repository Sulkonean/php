<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "include/head.php";
include_once "include/header.php";

$subtotal = 0;
?>


<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-section">
    <div class="untree_co-section before-footer-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="site-blocks-table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
                                <?php if (!empty($_SESSION['cart'])): ?>
                                    <?php foreach ($_SESSION['cart'] as $item):
                                        $total = $item['price'] * $item['quantity'];
                                        $subtotal += $total;
                                    ?>
                                        <tr data-product-id="<?= $item['id'] ?>">
                                            <td class="product-thumbnail">
                                                <img src="<?= htmlspecialchars($item['image']) ?>" alt="Image" class="img-fluid" width="50">
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black"><?= htmlspecialchars($item['name']) ?></h2>
                                            </td>
                                            <td>$<?= number_format($item['price'], 2) ?></td>
                                            <td>
                                                <div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
                                                    <button class="btn btn-outline-black decrease cart-action" data-action="decrease">&minus;</button>
                                                    <input type="text" class="form-control text-center quantity-amount" value="<?= $item['quantity'] ?>" readonly>
                                                    <button class="btn btn-outline-black increase cart-action" data-action="increase">&plus;</button>
                                                </div>
                                            </td>
                                            <td class="product-total">$<?= number_format($total, 2) ?></td>
                                            <td>
                                                <button class="btn btn-black btn-sm cart-action" data-action="remove">X</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">Your cart is empty</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="row mb-5">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block">Update Cart</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="text-black h4" for="coupon">Coupon</label>
                            <p>Enter your coupon code if you have one.</p>
                        </div>
                        <div class="col-md-8 mb-3 mb-md-0">
                            <input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-black">Apply Coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 pl-5">
                    <div class="row justify-content-end">
                        <div class="col-md-7">
                            <div class="row">
                                <div class="col-md-12 text-right border-bottom mb-5">
                                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <span class="text-black">Subtotal</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black cart-total">$<?= number_format($subtotal, 2) ?></strong>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <span class="text-black">Total</span>
                                </div>
                                <div class="col-md-6 text-right">
                                    <strong class="text-black cart-total">$<?= number_format($subtotal, 2) ?></strong>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-black btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>document.addEventListener("DOMContentLoaded", function () {
    const cartBody = document.getElementById("cart-body");
    const cartTotal = document.querySelectorAll(".cart-total");

    function updateCartTotals() {
        let subtotal = 0;
        document.querySelectorAll(".product-total").forEach(totalElement => {
            subtotal += parseFloat(totalElement.textContent.replace("$", "").trim());
        });

        cartTotal.forEach(el => el.textContent = `$${subtotal.toFixed(2)}`);
    }

    function updateCart(productId, action) {
        let formData = new FormData();
        formData.append("action", action);
        formData.append("id", productId); // Ensure 'id' matches PHP variable

        fetch("cart_action.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let row = document.querySelector(`[data-product-id='${productId}']`);

                if (action === "remove") {
                    row.remove();
                } else {
                    let quantityInput = row.querySelector(".quantity-amount");
                    let price = parseFloat(row.querySelector(".product-price").textContent.replace("$", "").trim());
                    let newQuantity = data.quantity;

                    quantityInput.value = newQuantity;
                    row.querySelector(".product-total").textContent = `$${(price * newQuantity).toFixed(2)}`;

                    row.querySelector(".decrease").disabled = newQuantity <= 1;
                }

                updateCartTotals();
            } else {
                alert(data.error || "Error updating cart!");
            }
        })
        .catch(error => console.error("Error:", error));
    }

    cartBody.addEventListener("click", function (event) {
        let target = event.target;
        let row = target.closest("tr");
        if (!row) return;

        let productId = row.dataset.productId;

        if (target.classList.contains("increase")) {
            updateCart(productId, "increase");
        } else if (target.classList.contains("decrease")) {
            updateCart(productId, "decrease");
        } else if (target.classList.contains("cart-action") && target.dataset.action === "remove") {
            if (confirm("Are you sure you want to remove this item?")) {
                updateCart(productId, "remove");
            }
        }
    });

    updateCartTotals();
});
function updateCart(productId, action) {
    let formData = new FormData();
    formData.append("action", action);
    formData.append("id", productId);

    fetch("cart_action.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("cart-count").textContent = data.cart_count; // Update cart count in navbar

            let row = document.querySelector(`[data-product-id='${productId}']`);
            if (action === "remove") {
                row.remove();
            } else {
                let quantityInput = row.querySelector(".quantity-amount");
                let price = parseFloat(row.querySelector(".product-price").textContent.replace("$", "").trim());
                let newQuantity = data.quantity;

                quantityInput.value = newQuantity;
                row.querySelector(".product-total").textContent = `$${(price * newQuantity).toFixed(2)}`;
            }

            updateCartTotals();
        } else {
            alert(data.error || "Error updating cart!");
        }
    })
    .catch(error => console.error("Error:", error));
} -->
    <script>document.addEventListener("DOMContentLoaded", function () {
    const cartBody = document.getElementById("cart-body");
    const cartTotalElements = document.querySelectorAll(".cart-total");
    const cartCount = document.getElementById("cart-count"); // Navbar cart count

    function updateCartTotals() {
        let subtotal = 0;
        document.querySelectorAll(".product-total").forEach(totalElement => {
            subtotal += parseFloat(totalElement.textContent.replace("$", "").trim());
        });

        cartTotalElements.forEach(el => el.textContent = `$${subtotal.toFixed(2)}`);
    }

    function updateCart(productId, action) {
        let formData = new FormData();
        formData.append("action", action);
        formData.append("id", productId);

        fetch("cart_action.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (cartCount) {
                    cartCount.textContent = data.cart_count; // Update navbar cart count
                }

                let row = document.querySelector(`[data-product-id='${productId}']`);
                if (!row) return; // Avoid errors if row is missing

                let quantityInput = row.querySelector(".quantity-amount");
                let priceElement = row.querySelector(".product-price");
                let totalElement = row.querySelector(".product-total");

                let price = parseFloat(priceElement.textContent.replace("$", "").trim());
                let newQuantity = data.quantity;

                // Update UI without refreshing
                quantityInput.value = newQuantity;
                totalElement.textContent = `$${(price * newQuantity).toFixed(2)}`;

                // Disable "decrease" button if quantity is 1
                row.querySelector(".decrease").disabled = newQuantity <= 1;

                updateCartTotals();

                // If cart is empty, show message
                if (!document.querySelector("[data-product-id]")) {
                    cartBody.innerHTML = `<tr><td colspan="6" class="text-center">Your cart is empty</td></tr>`;
                    cartTotalElements.forEach(el => el.textContent = "$0.00");
                }
            } else {
                alert(data.error || "Error updating cart!");
            }
        })
        .catch(error => console.error("Error:", error));
    }

    cartBody.addEventListener("click", function (event) {
        event.preventDefault(); // **STOP PAGE REFRESH!**

        let target = event.target;
        let row = target.closest("tr");
        if (!row) return;

        let productId = row.dataset.productId;

        if (target.classList.contains("increase")) {
            updateCart(productId, "increase");
        } else if (target.classList.contains("decrease")) {
            updateCart(productId, "decrease");
        } else if (target.classList.contains("cart-action") && target.dataset.action === "remove") {
            if (confirm("Are you sure you want to remove this item?")) {
                updateCart(productId, "remove");
            }
        }
    });

    updateCartTotals();
});








</script>


<?php include_once "include/footer.php"; ?>
<?php include_once "include/script.php"; ?>
