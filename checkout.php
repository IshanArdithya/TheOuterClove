<?php

$selectedItemsJSON = $_GET['items'] ?? '[]';
$selectedItems = json_decode(urldecode($selectedItemsJSON), true);

function calculateSubtotal($items) {
    $subtotal = 0;
    foreach ($items as $item) {
        $subtotal += floatval(str_replace('Rs. ', '', $item['price']));
    }
    return number_format($subtotal, 2);
}

function calculateTotal($items) {
    return calculateSubtotal($items);
}


?>

<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $streetAddress = $_POST['street-address'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $mobileNumber = $_POST['mobile-number'];
    $orderType = $_POST['order-type'];
    $orderNotes = $_POST['order-notes'];

    $productNames = [];
    $productPrices = [];

    foreach ($selectedItems as $item) {
        $productNames[] = $item['name'];
        $productPrices[] = $item['price'];
    }

    $productNameString = implode(", ", $productNames);
    $productPriceString = implode(", ", $productPrices);

    $sql = "INSERT INTO orders (first_name, last_name, street_address, city, email, mobile_number, order_type, order_notes, product_name, product_price)
            VALUES ('$firstName', '$lastName', '$streetAddress', '$city', '$email', '$mobileNumber', '$orderType', '$orderNotes', '$productNameString', '$productPriceString')";

    if ($conn->query($sql) === TRUE) {
        echo "Order submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<!-- -------------- Navigation Bar -------------- -->

    <header class="header">
        <a class="navbar-logo" href="index.php">The Outer <span class="theme-accent-color">Clove</span></a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="index.php#gallery">Gallery</a>
            <a href="reservations.php">Reservation</a>
            <a href="about.html">About</a>
            <a class="active" href="contact.php">Contact Us</a>
        </nav>

        <div class="icons">
            <div class="icons hideit">
                <a href="p1.html" class="material-symbols-outlined">search</a>
            </div>
          
            <div class="icons">
                <a href="p2.html" class="material-symbols-outlined">shopping_cart</a>
            </div>
          
            <div class="icons" id="account-icon">
                <a href="login.php" class="material-symbols-outlined">account_circle</a>
            </div>
        </div>
    </header>

    <!-- -------------- Background Image & Texts -------------- -->

    <div class="m-bg-container">
        <div class="low-dark"></div>
        <div class="m-bg-outer">
            <div class="m-menu-text">
                <h1>Checkout</h1>
                <div class="breadcrumb">
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="checkout.php">Checkout &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Contact Info -------------- -->

    <div class="main-color2">
        <div class="checkout-container">
            <!-- Billing Information -->
            <form id="billing-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="billing-information">
                    <h2>Billing Information</h2>
                    <div class="name-row">
                        <div class="form-group">
                            <label for="first-name">First Name:</label>
                            <input type="text" id="first-name" name="first-name" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name:</label>
                            <input type="text" id="last-name" name="last-name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="street-address">Street Address:</label>
                        <input type="text" id="street-address" name="street-address" required>
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile-number">Mobile Number:</label>
                        <input type="tel" id="mobile-number" name="mobile-number" required>
                    </div>
                    <div class="form-group">
                        <label for="order-type">Order Type:</label>
                        <select id="order-type" name="order-type" required>
                            <option value="" disabled selected hidden>Select an option</option>
                            <option value="takeout">Takeout</option>
                            <option value="delivery">Delivery</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="order-notes">Order Notes:</label>
                        <textarea id="order-notes" name="order-notes"></textarea>
                    </div>
                    <div class="form-group">
                        <p>* You'll be contacted by Staff to verify your payment method.</p>
                    </div>
                    <button class="submit-button" onclick="submitOrder()">Submit Order</button>
                </div>
            </form>

            <div class="your-order">
                <h2>Your Order</h2>
                <div class="order-details">
                    <?php foreach ($selectedItems as $item): ?>
                        <div class="product-details">
                            <div class="product-info">
                                <p class="product-name"><?php echo $item['name']; ?></p>
                            </div>
                            <div class="product-info">
                                <p class="product-price"><?php echo $item['price']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="order-summary">
                    <div class="total-row">
                        <span class="total-label">Subtotal:</span>
                        <span id="subtotal">Rs. <?php echo calculateSubtotal($selectedItems); ?></span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Total:</span>
                        <span id="total">Rs. <?php echo calculateTotal($selectedItems); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Footer -------------- -->

    <footer id="site-footer">
        <footer id="site-footer">
            <div class="footer-row">
                <div class="footer-column">
                    <h4>About Us</h4>
                    <p>The Outer Clove restaurant, serving delicious meals since 2002, has become a favorite across many cities in Sri Lanka. Our journey began with a passion for great food and a commitment to creating a welcoming dining experience for everyone.</p>
                </div>
        
                <div class="footer-column">
                    <h4>Opening Hours</h4>
                    <p>Monday - Friday</p>
                    <p>8 AM - 10 PM</p>
                    <p>Saturday - Sunday</p>
                    <p>9 AM - 8 PM</p>
                </div>
        
                <div class="footer-column">
                    <h4>Contact Us</h4>
                    <p>
                        Address: 123 Colombo, Sri Lanka<br>
                        Telephone: 011-456-7890<br>
                        Email: info@outerclover.com
                    </p>
                </div>
        
                <div class="footer-column">
                    <h4>Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="reservations.php">Reservation</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        
        <div class="footer-bottom">
            <p>Copyrights &copy; 2023 - <a href="https://github.com/IshanArdithya"><span class="theme-accent-color">Ishan Ardithya</span></a>, All Rights Reserved.</p>
        </div>

        <script>
            window.onscroll = function() {scrollFunction()};

            function scrollFunction() {
                if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.getElementById("header").style.background = "rgba(38, 38, 38, 1)";
                } else {
                document.getElementById("header").style.background = "transparent";
                }
            }
        </script>
    </footer>
</body>
</html>
    <?php
}
?>
    