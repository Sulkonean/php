<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    $product_id = (int) ($_POST['id'] ?? 0);
    $product_name = strip_tags(trim($_POST['name'] ?? ''));
    $product_price = floatval($_POST['price'] ?? 0);
    $product_image = strip_tags(trim($_POST['image'] ?? ''));
    $product_quantity = max(1, intval($_POST['quantity'] ?? 1)); // Prevent negative quantity

    if ($product_id <= 0) {
        echo json_encode(['error' => 'Invalid product ID']);
        exit;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    switch ($action) {
        case 'add':
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity'] += $product_quantity;
            } else {
                $_SESSION['cart'][$product_id] = [
                    'id' => $product_id,
                    'name' => $product_name,
                    'price' => $product_price,
                    'quantity' => $product_quantity,
                    'image' => $product_image
                ];
            }
            break;

        case 'increase':
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity']++;
            }
            break;

        case 'decrease':
            if (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id]['quantity'] > 1) {
                $_SESSION['cart'][$product_id]['quantity']--;
            }
            break;

        case 'remove':
            if (isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
            }
            break;

        default:
            echo json_encode(['error' => 'Invalid action']);
            exit;
    }

    // Calculate total cart count and subtotal
    $cart_count = 0;
    $subtotal = 0;

    foreach ($_SESSION['cart'] as $item) {
        $cart_count += $item['quantity'];
        $subtotal += $item['price'] * $item['quantity'];
    }

    echo json_encode([
        'success' => true,
        'quantity' => $_SESSION['cart'][$product_id]['quantity'] ?? 0,
        'cart_count' => $cart_count,
        'subtotal' => number_format($subtotal, 2)
    ]);
    exit;
}
