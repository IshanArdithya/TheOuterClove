<?php
include '../connectdb.php';
session_start();

// file_put_contents('log.txt', "POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn->begin_transaction();

    try {
        $billing_first_name = htmlspecialchars(trim($_POST['billing_first_name']));
        $billing_last_name = htmlspecialchars(trim($_POST['billing_last_name']));
        $billing_address_1 = htmlspecialchars(trim($_POST['billing_address_1']));
        $billing_address_2 = htmlspecialchars(trim($_POST['billing_address_2']));
        $billing_city = htmlspecialchars(trim($_POST['billing_city']));
        $billing_phone_number = htmlspecialchars(trim($_POST['billing_phone_number']));
        $billing_email = htmlspecialchars(trim($_POST['billing_email']));

        $shipping_option = htmlspecialchars(trim($_POST['shipping_option']));
        $timing_option = htmlspecialchars(trim($_POST['timing_option']));

        if (isset($_SESSION['Cart']) && !empty($_SESSION['Cart'])) {
            $cart = $_SESSION['Cart'];
            $total_price = 0;

            // checking if user logged in
            if (isset($_SESSION['user'])) {
                $userId = $_SESSION['user']['id'];
            } else {
                $userId = null;
            }

            // checking whether delivery/pickup
            if ($shipping_option == 'delivery') {
                $total_price = $_POST['finalTotalDelivery'];
            } elseif ($shipping_option == 'pickup') {
                $total_price = $_POST['finalTotalPickup'];
            }

            // now/scheduled time
            if ($timing_option == 'now') {
                $sql = "INSERT INTO orders (user_id, total_amount, shipping_option, shipping_time)
                        VALUES (?, ?, ?, NOW())";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sds", $userId, $total_price, $shipping_option);
            } else {
                $scheduledDateTime = $_POST['timing_option'];
                $dateTime = DateTime::createFromFormat('Y-m-d h:i A', $scheduledDateTime);
                $shipping_time = $dateTime ? $dateTime->format('Y-m-d H:i:s') : null;

                if ($shipping_time === null) {
                    throw new Exception('Invalid scheduled date and time.');
                }

                $sql = "INSERT INTO orders (user_id, total_amount, shipping_option, shipping_time)
                        VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isss", $userId, $total_price, $shipping_option, $shipping_time);
            }

            if (!$stmt->execute()) {
                throw new Exception('Failed to insert order.');
            }

            $order_id = $conn->insert_id;

            // billing address
            $sql = "INSERT INTO addresses (user_id, order_id, address_type, first_name, last_name, address_1, address_2, city, phone_number, email)
                    VALUES (?, ?, 'billing', ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iisssssis", $userId, $order_id, $billing_first_name, $billing_last_name, $billing_address_1, $billing_address_2, $billing_city, $billing_phone_number, $billing_email);
            if (!$stmt->execute()) {
                throw new Exception('Failed to insert billing address.');
            }

            // shipping address if deliverySender is not checked
            if (!isset($_POST['deliverySender'])) {
                $delivery_first_name = htmlspecialchars(trim($_POST['delivery_first_name']));
                $delivery_last_name = htmlspecialchars(trim($_POST['delivery_last_name']));
                $delivery_address_1 = htmlspecialchars(trim($_POST['delivery_address_1']));
                $delivery_address_2 = htmlspecialchars(trim($_POST['delivery_address_2']));
                $delivery_city = htmlspecialchars(trim($_POST['delivery_city']));
                $delivery_phone_number = htmlspecialchars(trim($_POST['delivery_phone_number']));
                $delivery_email = htmlspecialchars(trim($_POST['delivery_email']));

                $sql = "INSERT INTO addresses (user_id, order_id, address_type, first_name, last_name, address_1, address_2, city, phone_number, email)
                        VALUES (?, ?, 'shipping', ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iisssssis", $userId, $order_id, $delivery_first_name, $delivery_last_name, $delivery_address_1, $delivery_address_2, $delivery_city, $delivery_phone_number, $delivery_email);
                if (!$stmt->execute()) {
                    throw new Exception('Failed to insert shipping address.');
                }
            }

            // order items
            foreach ($cart as $product_id => $quantity) {
                $sql = "SELECT product_price FROM products WHERE product_id = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $product_id);
                $stmt->execute();
                $stmt->bind_result($product_price);
                $stmt->fetch();
                $stmt->close();

                $sql = "INSERT INTO order_items (order_id, product_id, quantity, price)
                        VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $product_price);
                if (!$stmt->execute()) {
                    throw new Exception('Failed to insert order items.');
                }
            }

            $payment_method = $_POST['payment_method'];
            $transaction_id = 'null';
            $payment_status = 'pending';

            if ($payment_method == 'paypal') {
                $transaction_id = $_POST['paypal_transaction_id'];
                $payment_status = 'completed';
            } elseif ($payment_method == 'Visa') {
                $payment_status = 'pending';
            }

            $sql = "INSERT INTO payments (order_id, payment_date, amount, payment_method, payment_status, transaction_id)
                    VALUES (?, NOW(), ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("idsss", $order_id, $total_price, $payment_method, $payment_status, $transaction_id);

            if (!$stmt->execute()) {
                throw new Exception('Failed to insert payment details.');
            }

            $conn->commit();

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Cart is empty.']);
        }
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}

?>