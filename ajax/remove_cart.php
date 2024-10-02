<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $product_id = intval($_POST['product_id']);

    if (isset($_SESSION['Cart'][$product_id])) {
        $_SESSION['Cart'][$product_id] -= 1;

        if ($_SESSION['Cart'][$product_id] <= 0) {
            unset($_SESSION['Cart'][$product_id]);
        }

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}

?>