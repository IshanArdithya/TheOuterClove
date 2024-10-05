<?php
session_start();
include '../../connectdb.php';

if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
    $cart_items = $_SESSION['Cart'];
    $product_ids = array_keys($cart_items);
    $product_ids_str = implode(',', $product_ids);

    $query = "SELECT id, product_title, product_description, image_path, product_price FROM products WHERE id IN ($product_ids_str)";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Initialize a variable to hold the cart items HTML
        $cartHtml = '';
        
        while ($row = $result->fetch_assoc()) {
            $product_id = $row['id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $image_path = $row['image_path'];
            $product_price = $row['product_price'];
            $quantity = $cart_items[$product_id];

            // Append each item to the cart HTML
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

        // Return the cart items HTML
        echo json_encode(['success' => true, 'cartHtml' => $cartHtml]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No products found in cart.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Cart is empty.']);
}
?>
