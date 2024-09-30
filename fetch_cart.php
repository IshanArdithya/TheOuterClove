<?php
session_start();
include 'connectdb.php';

$cartItems = [];

if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
    $productIds = array_keys($_SESSION['Cart']);

    if (!empty($productIds)) {
        $ids = implode(',', $productIds);
        $sql = "SELECT id, product_title, product_price, image_path FROM products WHERE id IN ($ids)";
        $cartResult = $conn->query($sql);

        if ($cartResult->num_rows > 0) {
            while ($row = $cartResult->fetch_assoc()) {
                $productId = $row['id'];
                $quantity = $_SESSION['Cart'][$productId];

                $cartItems[] = [
                    'id' => $productId,
                    'name' => $row['product_title'],
                    'price' => $row['product_price'],
                    'image' => $row['image_path'],
                    'quantity' => $quantity
                ];
            }
        }
    }
    echo json_encode($cartItems);
}
?>