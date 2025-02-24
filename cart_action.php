<?php
session_start();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Validate inputs
    $product_id = strip_tags(trim($_POST['id'] ?? ''));
    $product_name = strip_tags(trim($_POST['name'] ?? ''));
    $product_price = strip_tags(trim($_POST['price'] ?? ''));
    $product_image = strip_tags(trim($_POST['image'] ?? ''));
    $product_quantity = intval($_POST['quantity'] ?? 1);

    if (!is_numeric($product_id) || empty($product_id)) {
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
                    'price' => floatval($product_price),
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

    // Calculate total cart count
    $cart_count = array_sum(array_column($_SESSION['cart'], 'quantity'));

    // Return updated quantity and cart count
    echo json_encode([
        'success' => true,
        'quantity' => $_SESSION['cart'][$product_id]['quantity'] ?? 0,
        'cart_count' => $cart_count
    ]);
    exit;
}
?>
