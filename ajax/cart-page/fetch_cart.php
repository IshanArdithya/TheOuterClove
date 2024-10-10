<?php
session_start();
include '../../connectdb.php';

$total_price = 0;
$item_count = 0;
$tax_rate_percentage = 3.4;
$tax_rate = $tax_rate_percentage / 100;
$final_total = 0;
$tax = 0;
$delivery_fee = 10.00;

if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
    $cart_items = $_SESSION['Cart'];
    $product_ids = array_keys($cart_items);
    $product_ids_str = implode(',', $product_ids);

    $query = "SELECT product_id, product_title, product_description, image_path, product_price FROM products WHERE product_id IN ($product_ids_str)";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $cartHtml = '';

        while ($row = $result->fetch_assoc()) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $image_path = $row['image_path'];
            $product_price = $row['product_price'];
            $quantity = $cart_items[$product_id];

            $item_count += $quantity;
            $total_price += $product_price * $quantity;

            $cartHtml .= '<div class="cart-page-item" data-product-id="' . $product_id . '">
                <div class="cart-page-item-image">
                    <img src="' . $image_path . '" alt="' . $product_title . '">
                </div>
                <div class="cart-page-item-details">
                    <div class="cart-page-item-details-top">
                        <div class="cart-page-item-details-left">
                            <div class="cart-page-item-title">
                                <p>' . $product_title . '</p>
                                <p>$' . number_format($product_price, 2) . '</p>
                            </div>
                            <p class="cart-page-item-description">' . $product_description . '</p>
                        </div>
                        <div class="cart-page-item-details-right">
                            <div class="cart-page-item-remove">
                                <button class="remove-btn" data-product-id="' . $product_id . '">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000">
                                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="cart-page-item-details-bottom">
                        <div class="cart-page-item-bottom">
                            <div class="custom-dropdown">
                                <select class="select2-dropdown cart-page-item-quantity" data-product-id="' . $product_id . '">';
            for ($i = 1; $i <= 10; $i++) {
                $cartHtml .= '<option value="' . $i . '" ' . ($i == $quantity ? 'selected' : '') . '>' . $i . '</option>';
            }
            $cartHtml .= '</select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }

        $tax = $total_price * $tax_rate; // tax not include delivery
        $final_total_pickup = $total_price + $tax; // without delivery fee
        $final_total_delivery = $total_price + $tax + $delivery_fee;

        echo json_encode([
            'success' => true,
            'cartHtml' => $cartHtml,
            'itemCount' => $item_count,
            'totalPrice' => number_format($total_price, 2),
            'deliveryFee' => number_format($delivery_fee, 2),
            'tax' => number_format($tax, 2),
            'taxRate' => $tax_rate_percentage . '%',
            'finalTotalPickup' => number_format($final_total_pickup, 2),
            'finalTotalDelivery' => number_format($final_total_delivery, 2)
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No products found in cart.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Cart is empty.']);
}
?>