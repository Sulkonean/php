<?php
// Get the transaction ID and status from the URL
$transactionId = $_GET['tran_id'];
$status = $_GET['status'];

// Check if the payment is successful
if ($status == 'success') {
    // Send order details to Telegram if payment is successful
    sendToTelegram($transactionId);
    echo "Payment Successful. Thank you for your order!";
} else {
    echo "Payment failed. Please try again.";
}

// Function to send order details to Telegram
function sendToTelegram($transactionId) {
    $telegramBotToken = "8185720035:AAGpwBrUvfLX_Y9WUp6ePoJ4FWq5jfaoXNY";
    $telegramChatId = "2076551922";

    // Send the message to Telegram
    $message = "Payment successful for transaction ID: $transactionId";
    $url = "https://api.telegram.org/bot$telegramBotToken/sendMessage?chat_id=$telegramChatId&text=" . urlencode($message);

    // Use file_get_contents to send the request
    file_get_contents($url);
}
?>
