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

    // Respond with success
    echo json_encode(['success' => true]);
    exit;
}
?>
