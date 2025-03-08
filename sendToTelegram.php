<?php
session_start();

// Telegram bot token and chat ID
$botToken = "8185720035:AAGpwBrUvfLX_Y9WUp6ePoJ4FWq5jfaoXNY";
$chatId = "2076551922";

// Get the POST data from the form
$name = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];

// Sample cart data from session (assuming it's already stored in session)
$items = $_SESSION['cart'];

// Calculate the total
$subtotal = 0;
foreach ($items as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

// Format the message
$message = "🆕 *New Invoice :*\n";
$message .= "👤 *Name:* {$name}\n";
$message .= "📧 *Email:* {$email}\n";
$message .= "📍 *Shipping Address:* {$address}\n";
$message .= "📞 *Phone Number:* {$phone}\n";
$message .= "💵 *Total:* \${$subtotal}\n\n";

$message .= "🛍 *Items:*\n";

foreach ($items as $item) {
    $message .= "🧥 *Product:* {$item['name']}\n";
    $message .= "📏 *Size:* {$item['size']}\n";
    $message .= "🔢 *Quantity:* {$item['quantity']}\n";
    $message .= "💲 *Price:* \${$item['price']}\n";
    $message .= "🌐 *Product Image:* [View Image]({$item['image']})\n\n";
}

// Send message to Telegram bot
$sendMessageUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$messageData = [
    'chat_id' => $chatId,
    'parse_mode' => 'Markdown',
    'text' => $message,
];

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "Content-Type:application/x-www-form-urlencoded\r\n",
        'content' => http_build_query($messageData),
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($sendMessageUrl, false, $context);

// Debug the response to see the error message
if ($response === FALSE) {
    $error = error_get_last();
    echo "Failed to send message. Error: " . $error['message'];
} else {
    $result = json_decode($response, true);
    if ($result['ok']) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . $result['description'];
    }
}
?>






