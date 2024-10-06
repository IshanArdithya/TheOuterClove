<?php
session_start();
include '../../connectdb.php';

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    if ($quantity < 1) {
        unset($_SESSION['Cart'][$product_id]);
        echo json_encode(['success' => true, 'message' => 'Item removed from cart.']);
    } else {
        $_SESSION['Cart'][$product_id] = $quantity;
        echo json_encode(['success' => true, 'message' => 'Quantity updated successfully.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
