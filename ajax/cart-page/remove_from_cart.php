<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    if (isset($_SESSION['Cart'][$product_id])) {
        unset($_SESSION['Cart'][$product_id]);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found in cart.']);
    }
    exit;
}
?>
