
<script src="js/bootstrap.bundle.min.js"></script>
		<script src="js/tiny-slider.js"></script>
		<script src="js/custom.js"></script>

		<!-- <script>
function updateQuantity(id, change) {
    fetch('update_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `product_id=${id}&change=${change}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Refresh to reflect changes
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}
</script> -->