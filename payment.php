<?php
session_start();

// Example cart data (replace with actual cart logic)
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Check if cart is empty
if (empty($cart)) {
    die(json_encode(["error" => "Cart is empty"]));
}

// Calculate total amount
$totalAmount = 0;
$items = [];

foreach ($cart as $id => $item) {
    $totalAmount += $item['price'] * $item['quantity'];
    $items[] = [
        "name" => $item['name'],
        "quantity" => $item['quantity'],
        "price" => number_format($item['price'], 2, '.', '')
    ];
}

// Create a unique transaction ID
$transactionId = "ORDER-" . time();

// ABA PayWay API credentials
$merchantId = "ec449300"; // Replace with your merchant ID
$currency = "USD";
$shipping = 1.35; // Fixed shipping cost (optional)
$reqTime = time();

// Convert items to JSON
$itemsJson = json_encode($items);

// Generate hash (Replace with your ABA PayWay hash logic)
$hash = base64_encode(hash_hmac('sha256', $transactionId . $totalAmount, "YOUR_SECRET_KEY", true));

// Create redirect URL
$paymentUrl = "https://link.payway.com.kh/aba?id=1A2438FC3F6F&code=716318&acc=003320500&dynamic=true"
    . "hash=" . urlencode($hash)
    . "&tran_id=" . urlencode($transactionId)
    . "&amount=" . urlencode($totalAmount)
    . "&firstname=Customer"
    . "&lastname=User"
    . "&phone=0123456789"
    . "&email=customer@example.com"
    . "&items=" . urlencode($itemsJson)
    . "&return_params=Order+Completed"
    . "&shipping=" . urlencode($shipping)
    . "&currency=" . urlencode($currency)
    . "&type=purchase"
    . "&merchant_id=" . urlencode($merchantId)
    . "&req_time=" . urlencode($reqTime);

// Store transaction details (optional)
$_SESSION['transaction_id'] = $transactionId;
$_SESSION['amount'] = $totalAmount;

// Redirect to ABA PayWay
header("Location: $paymentUrl");
exit;
?>