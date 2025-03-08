<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<?php include "include/head.php"; ?>

<body>
	<?php include_once "include/header.php"; ?>

	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1>Checkout</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="untree_co-section">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12">
					<div class="border p-4 rounded" role="alert">
						Returning customer? <a href="#">Click here</a> to login
					</div>
				</div>
			</div>

			<form id="checkoutForm" action="sendToTelegram.php" method="POST">
				<div class="row">
					<!-- Billing details and order details as before -->
					<div class="col-md-6 mb-5 mb-md-0">
						<h2 class="h3 mb-3 text-black">Billing Details</h2>
						<div class="p-3 p-lg-5 border bg-white">
							<div class="form-group">
								<label for="name">Full Name</label>
								<input type="text" class="form-control required" id="name" name="name" placeholder="Your full name" required>
							</div>
							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" class="form-control required" id="email" name="email" placeholder="Your email address" required>
							</div>
							<div class="form-group">
								<label for="address">Shipping Address</label>
								<input type="text" class="form-control required" id="address" name="address" placeholder="Your shipping address" required>
							</div>
							<div class="form-group">
								<label for="phone">Phone Number</label>
								<input type="tel" class="form-control required" id="phone" name="phone" placeholder="Your phone number" required>
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<h2 class="h3 mb-3 text-black">Your Order</h2>

						<div class="p-3 p-lg-5 border bg-white">
							<table class="table site-block-order-table mb-5">
								<thead>
									<th>Product</th>
									<th>Total</th>
								</thead>
								<tbody>
									<?php
									$subtotal = 0;
									if (!empty($_SESSION['cart'])):
										foreach ($_SESSION['cart'] as $item):
											$total = $item['price'] * $item['quantity'];
											$subtotal += $total;
									?>
											<tr>
												<td><?= htmlspecialchars($item['name']) ?> <strong class="mx-2">x</strong> <?= $item['quantity'] ?></td>
												<td>$<?= number_format($total, 2) ?></td>
											</tr>
										<?php endforeach; ?>
										<tr>
											<td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
											<td class="text-black">$<?= number_format($subtotal, 2) ?></td>
										</tr>
										<tr>
											<td class="text-black font-weight-bold"><strong>Order Total</strong></td>
											<td class="text-black font-weight-bold"><strong>$<?= number_format($subtotal, 2) ?></strong></td>
										</tr>
									<?php else: ?>
										<tr>
											<td colspan="2" class="text-center">Your cart is empty</td>
										</tr>
									<?php endif; ?>
								</tbody>
							</table>
							<button type="submit" id="placeOrderBtn" class="btn btn-black btn-lg py-3 btn-block" disabled>
								Proceed to Payment
							</button>
						</div>
					</div>
				</div>
			</form>


		</div>
	</div>

	<?php include "include/footer.php"; ?>
	<?php include "include/script.php"; ?>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const requiredFields = document.querySelectorAll(".required");
			const placeOrderBtn = document.getElementById("placeOrderBtn");

			// Form validation function
			function validateForm() {
				let allFilled = true;
				requiredFields.forEach((field) => {
					if (!field.value.trim()) {
						allFilled = false;
					}
				});

				placeOrderBtn.disabled = !allFilled;
			}

			// Event listener for required fields
			requiredFields.forEach((field) => {
				field.addEventListener("input", validateForm);
			});

			// Initial form validation on page load
			validateForm();
		});
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const checkoutForm = document.getElementById("checkoutForm");
			const placeOrderBtn = document.getElementById("placeOrderBtn");

			// Form validation
			function validateForm() {
				const requiredFields = document.querySelectorAll(".required");
				let allFilled = true;
				requiredFields.forEach((field) => {
					if (!field.value.trim()) {
						allFilled = false;
					}
				});
				placeOrderBtn.disabled = !allFilled;
			}

			checkoutForm.addEventListener("submit", function(event) {
				event.preventDefault(); // Prevent the form from submitting normally

				// Gather form data
				const formData = new FormData(checkoutForm);


				// Send data to sendToTelegram.php via AJAX
				const telegramRequest = new XMLHttpRequest();
				telegramRequest.open("POST", "sendToTelegram.php", true);
				telegramRequest.onreadystatechange = function() {
					if (telegramRequest.readyState == 4 && telegramRequest.status == 200) {
						// Handle Telegram response if needed
						console.log("Telegram message sent.");
					}
				};
				telegramRequest.send(formData);
			});

			// Enable the place order button if the form is valid
			const requiredFields = document.querySelectorAll(".required");
			requiredFields.forEach(field => {
				field.addEventListener("input", validateForm);
			});

			validateForm(); // Initial validation
		});
	</script>
</body>

</html>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const requiredFields = document.querySelectorAll(".required");
		const placeOrderBtn = document.getElementById("placeOrderBtn");

		// Form validation function
		function validateForm() {
			let allFilled = true;
			requiredFields.forEach((field) => {
				if (!field.value.trim()) {
					allFilled = false;
				}
			});

			placeOrderBtn.disabled = !allFilled;
		}

		// Event listener for required fields
		requiredFields.forEach((field) => {
			field.addEventListener("input", validateForm);
		});

		// Initial form validation on page load
		validateForm();

		// Handle form submission
		document.getElementById("checkoutForm").addEventListener("submit", function(event) {
			event.preventDefault(); // Prevent the form from submitting normally

			const formData = new FormData(this);

			// Redirect to the payment page with form data (e.g., paymentgateway.php)
			const paymentUrl = "payment.php"; // Replace with your payment URL

			// Add any necessary parameters to the payment URL (for example, product data)
			const queryString = new URLSearchParams(formData).toString();

			// Redirect the user to the payment gateway with the form data as query parameters
			window.location.href = `${paymentUrl}?${queryString}`;
		});
	});
</script>