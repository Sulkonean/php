<?php
session_start();
header('Content-Type: application/json');

// Calculate total cart quantity
$cart_count = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;

// Return cart count as JSON
echo json_encode(['cart_count' => $cart_count]);
?>
