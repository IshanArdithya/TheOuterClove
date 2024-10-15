<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    if (!isset($_SESSION['Cart'])) {
        $_SESSION['Cart'] = [];
    }

    if (isset($_SESSION['Cart'][$product_id])) {
        $_SESSION['Cart'][$product_id] += 1;
    } else {
        $_SESSION['Cart'][$product_id] = 1;
    }

    echo json_encode([
        'success' => true,
        'message' => 'Product added to cart successfully.'
        // 'itemCount' => array_sum($_SESSION['Cart']), // Total items in cart
    ]);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
