<?php
header("Content-Type: application/json");
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load ABA PayWay credentials securely
require_once "config.php";

// Check if cart exists in session
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo json_encode(["error" => "Cart is empty"]);
    exit;
}

// Initialize payment details
$req_time = time();
$transactionId = "ORDER-" . $req_time; // Unique order ID
$amount = 0;
$itemsArray = [];

// Process each cart item
foreach ($_SESSION['cart'] as $item) {
    $itemPrice = floatval($item['price']);
    $itemQuantity = intval($item['quantity']);
    $amount += $itemPrice * $itemQuantity;

    $itemsArray[] = [
        "name" => htmlspecialchars($item["name"]),
        "quantity" => (string) $itemQuantity,
        "price" => number_format($itemPrice, 2, '.', '')
    ];
}

// Encode cart items
$items = base64_encode(json_encode($itemsArray));

// Customer details (You can replace this with actual user input)
$firstName = "Customer";
$lastName = "User";
$phone = "0123456789";
$email = "customer@example.com";

// Additional order details
$shipping = "1.35";
$return_params = "Order Completed";
$type = "purchase";
$currency = "USD";

// Generate secure hash for ABA PayWay
$hash_string = $req_time . ABA_PAYWAY_MERCHANT_ID . $transactionId . $amount . $items . $shipping . 
               $firstName . $lastName . $email . $phone . $type . $currency . $return_params;
$hash = base64_encode(hash_hmac("sha512", $hash_string, ABA_PAYWAY_API_KEY, true));

// Create payment URL
$redirect_url = ABA_PAYWAY_API_URL . "?hash=" . urlencode($hash) .
    "&tran_id=" . urlencode($transactionId) .
    "&amount=" . urlencode($amount) .
    "&firstname=" . urlencode($firstName) .
    "&lastname=" . urlencode($lastName) .
    "&phone=" . urlencode($phone) .
    "&email=" . urlencode($email) .
    "&items=" . urlencode($items) .
    "&return_params=" . urlencode($return_params) .
    "&shipping=" . urlencode($shipping) .
    "&currency=" . urlencode($currency) .
    "&type=" . urlencode($type) .
    "&merchant_id=" . urlencode(ABA_PAYWAY_MERCHANT_ID) .
    "&req_time=" . urlencode($req_time);

// Debug log for troubleshooting
file_put_contents("debug_log.txt", print_r([
    "cart" => $_SESSION['cart'],
    "transactionId" => $transactionId,
    "amount" => $amount,
    "hash" => $hash,
    "redirect_url" => $redirect_url
], true));

// Return response as JSON
echo json_encode(["redirect_url" => $redirect_url]);
exit;
?>

<script>
    fetch("process_payment.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" }
})
.then(response => response.json())
.then(data => {
    if (data.redirect_url) {
        window.location.href = data.redirect_url; // Redirect to ABA payment page
    } else {
        console.error("Payment error:", data.error);
        alert("Payment failed: " + data.error);
    }
});

</script>