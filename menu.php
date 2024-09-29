<?php
include 'connectdb.php';

$sql = "SELECT * FROM products";

if (isset($_GET['search-submit'])) {
    $searchTerm = $_GET['search'];

    $sql = "SELECT * FROM products WHERE product_title LIKE '%$searchTerm%' OR product_description LIKE '%$searchTerm%'";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = intval($_POST['product_id']); // Get product ID from the form submission

    // Initialize the cart session if it doesn't exist
    if (!isset($_SESSION['Cart'])) {
        $_SESSION['Cart'] = [];
    }

    // Check if the product is already in the cart
    if (isset($_SESSION['Cart'][$product_id])) {
        // Increase the quantity if the product is already in the cart
        $_SESSION['Cart'][$product_id] += 1;
    } else {
        // Add the product to the cart with quantity 1 if it's not already in the cart
        $_SESSION['Cart'][$product_id] = 1;
    }

    // Display a success message
    $message = "Product added to cart!";
}

$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cart.css">

</head>

<body>

    <!-- -------------- Navigation Bar -------------- -->

    <?php
    include 'components/header.php'
        ?>

    <!-- -------------- Background Image & Texts -------------- -->

    <div class="m-bg-container">
        <div class="low-dark"></div>
        <div class="m-bg-outer">
            <div class="m-menu-text">
                <h1>MENU</h1>
                <div class="breadcrumb">
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="menu.php">Menu &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Menu Cards -------------- -->

    <div id="menu" class="main-color1">
        <div class="heading-wrap">
            <h2 class="block-title">CHECK OUT WHAT'S <span class="theme-accent-color">COOKIN'</span></h2>
            <h3 class="mini-title">Discover delightful dishes at pocket-friendly prices!</h3>
        </div>

        <section class="products">
            <h2>Our Products</h2>
            <form id="search-form" action="menu.php" method="get" class="search-form">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" name="search-submit">Search</button>
            </form>
            <div class="all-products">
                <?php

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <div class="product">
                            <img src="<?php echo $row['image_path']; ?>" alt="<?php echo $row['product_title']; ?>">
                            <div class="product-info">
                                <h4 class="product-title"><?php echo $row['product_title']; ?></h4>
                                <p class="product-description"><?php echo $row['product_description']; ?></p>
                                <p class="product-price">Rs.<?php echo $row['product_price']; ?></p>

                                <!-- Add to Cart Form -->
                                <form method="post" action="">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="add_to_cart">Add to Cart</button>
                                </form>
                            </div>
                        </div>

                        <?php
                    }
                } else {
                    echo "<p>No products available</p>";
                }
                ?>
            </div>
        </section>
    </div>

    <!-- -------------- Footer -------------- -->

    <?php
    include 'components/footer.php';
    ?>

    <!-- Shopping Cart Section -->
    <div id="shopping-cart" class="cart-container">
        <div class="cart-header">
            <h2>SHOPPING CART</h2>
            <button id="close-cart-btn">&times;</button>
        </div>
        <div class="cart-content">
            <div id="cart-items"></div>
        </div>
        <div class="cart-footer">
            <div id="total-price">TOTAL: Rs. 0</div>
            <button id="checkout-btn">Checkout</button>
        </div>
    </div>

    <script>
        function addToCartClicked(event) {
            var productContainer = event.target.closest('.product');
            var productName = productContainer.querySelector('.product-title').innerText;
            var productPrice = parseFloat(productContainer.querySelector('.product-price').innerText.replace('Rs.', ''));

            var cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
            <img src="${productContainer.querySelector('img').src}" alt="${productName}">
            <div>
                <p>${productName}</p>
                <p>Rs. ${productPrice.toFixed(2)}</p>
            </div>
        `;

            document.getElementById('cart-items').appendChild(cartItem);

            updateTotalPrice(productPrice);

            document.getElementById('shopping-cart').style.display = 'block';
        }
        function updateTotalPrice(productPrice) {
            var totalPriceElement = document.getElementById('total-price');
            var currentTotal = parseFloat(totalPriceElement.innerText.replace('TOTAL: Rs. ', ''));
            var newTotal = currentTotal + productPrice;
            totalPriceElement.innerText = 'TOTAL: Rs. ' + newTotal.toFixed(2);
        }

        var addToCartButtons = document.querySelectorAll('.product-btn');
        addToCartButtons.forEach(function (button) {
            button.addEventListener('click', addToCartClicked);
        });

        function toggleShoppingCart() {
            var shoppingCart = document.getElementById('shopping-cart');
            shoppingCart.style.display = (shoppingCart.style.display === 'block') ? 'none' : 'block';
        }

        var shoppingIcon = document.getElementById('shopping-icon');
        shoppingIcon.addEventListener('click', toggleShoppingCart);

        var closeCartBtn = document.getElementById('close-cart-btn');
        closeCartBtn.addEventListener('click', toggleShoppingCart);


        function checkoutClicked() {
            var selectedItems = [];
            var cartItems = document.querySelectorAll('.cart-item');

            cartItems.forEach(function (item) {
                var productName = item.querySelector('p:first-child').innerText;
                var productPrice = item.querySelector('p:last-child').innerText;

                var product = {
                    name: productName,
                    price: productPrice
                };

                selectedItems.push(product);
            });

            var selectedItemsJSON = JSON.stringify(selectedItems);

            window.location.href = 'checkout.php?items=' + encodeURIComponent(selectedItemsJSON);
        }

        var checkoutBtn = document.getElementById('checkout-btn');
        checkoutBtn.addEventListener('click', checkoutClicked);
    </script>


</body>

</html>