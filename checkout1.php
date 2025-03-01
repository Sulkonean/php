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
			<form id="checkoutForm">
				<div class="row">
					<div class="col-md-6 mb-5 mb-md-0">
						<h2 class="h3 mb-3 text-black">Billing Details</h2>
						<div class="p-3 p-lg-5 border bg-white">
							<div class="form-group">
								<label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" id="c_fname" name="c_fname">
							</div>
							<div class="form-group">
								<label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" id="c_lname" name="c_lname">
							</div>
							<div class="form-group">
								<label for="c_email" class="text-black">Email Address <span class="text-danger">*</span></label>
								<input type="email" class="form-control required" id="c_email" name="c_email">
							</div>
							<div class="form-group">
								<label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" id="c_phone" name="c_phone">
							</div>
							<div class="form-group">
								<label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
								<input type="text" class="form-control required" id="c_address" name="c_address">
							</div>
						</div>
					</div>

					<div class="col-md-6">
						<h2 class="h3 mb-3 text-black">Payment</h2>
						<div class="p-3 p-lg-5 border bg-white">
							<button type="submit" id="placeOrderBtn" class="btn btn-black btn-lg py-3 btn-block" disabled>
								Place Order
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
			const checkoutForm = document.getElementById("checkoutForm");

			function validateForm() {
				let allFilled = true;
				requiredFields.forEach((field) => {
					if (!field.value.trim()) {
						allFilled = false;
					}
				});

				placeOrderBtn.disabled = !allFilled;
			}

			requiredFields.forEach((field) => {
				field.addEventListener("input", validateForm);
			});

			checkoutForm.addEventListener("submit", function(e) {
				if (placeOrderBtn.disabled) {
					e.preventDefault();
					alert("Please fill all required fields before placing the order.");
				} else {
					window.location.href = "payment.php"; // Redirect after validation
					e.preventDefault(); // Prevent actual form submission
				}
			});
		});
	</script>
</body>

</html>