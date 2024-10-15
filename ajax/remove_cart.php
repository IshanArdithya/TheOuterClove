<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    if (isset($_SESSION['Cart'][$product_id])) {
        $_SESSION['Cart'][$product_id] -= 1;

        if ($_SESSION['Cart'][$product_id] <= 0) {
            unset($_SESSION['Cart'][$product_id]);
        }

        echo json_encode([
            'success' => true,
            'message' => 'Product removed from cart successfully.'
            // 'itemCount' => array_sum($_SESSION['Cart']),
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Product not found in cart.',
        ]);
    }
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
