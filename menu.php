<?php
include 'connectdb.php';

session_start();

$cartItems = [];

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if (isset($_GET['search-submit'])) {
    $searchTerm = $_GET['search'];

    $sql = "SELECT * FROM products WHERE product_title LIKE '%$searchTerm%' OR product_description LIKE '%$searchTerm%'";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $product_id = intval($_POST['product_id']);

    if (isset($_SESSION['Cart'][$product_id])) {
        $_SESSION['Cart'][$product_id] -= 1;

        if ($_SESSION['Cart'][$product_id] <= 0) {
            unset($_SESSION['Cart'][$product_id]);
        }

        $message = "Product removed from cart!";
    }
}

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
                                <form id="add-to-cart-form-<?php echo $row['id']; ?>" class="add-to-cart-form" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                    <button class="product-btn" type="submit" name="add_to_cart">Add to Cart</button>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cartIcon = document.getElementById("shopping-icon");
            const shoppingCart = document.getElementById("shopping-cart");
            const closeCartBtn = document.getElementById("close-cart-btn");
            const addToCartForms = document.querySelectorAll(".add-to-cart-form");

            addToCartForms.forEach(function (form) {
                form.addEventListener("submit", function (event) {
                    event.preventDefault();

                    const formData = new FormData(this);

                    fetch('add_to_cart.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Product added to cart!");
                                updateCartItems();
                            }
                        })
                        .catch(error => {
                            console.error('Error adding to cart:', error);
                        });
                });
            });

            function updateCartItems() {
                fetch('fetch_cart.php')
                    .then(response => response.json())
                    .then(data => {
                        const cartItemsContainer = document.getElementById('cart-items');
                        cartItemsContainer.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(item => {
                                const cartItem = document.createElement('div');
                                cartItem.classList.add('cart-item');
                                cartItem.innerHTML = `
                            <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                            <div class="cart-item-details">
                                <h4>${item.name}</h4>
                                <p><span class="product-price">${item.quantity}</span> × <span class="price-currency">LKR</span> <span class="product-price">${Number(item.price).toLocaleString('en', { minimumFractionDigits: 2 })}</span></p>
                            </div>
                            <form method="post" action="">
                                <input type="hidden" name="product_id" value="${item.id}">
                                <button type="submit" name="remove_from_cart" class="popup-cart-remove-btn">×</button>
                            </form>
                        `;
                                cartItemsContainer.appendChild(cartItem);
                            });
                        } else {
                            cartItemsContainer.innerHTML = '<p>Your cart is empty</p>';
                        }
                    })
                    .catch(error => console.error('Error fetching cart items:', error));
            }

            cartIcon.addEventListener("click", function (event) {
                event.stopPropagation();
                if (shoppingCart.style.display === "block") {
                    shoppingCart.style.display = "none";
                } else {
                    updateCartItems();
                    shoppingCart.style.display = "block";
                }
            });

            if (closeCartBtn) {
                closeCartBtn.addEventListener("click", function (event) {
                    event.stopPropagation();
                    shoppingCart.style.display = "none";
                });
            }

            shoppingCart.addEventListener("click", function (event) {
                event.stopPropagation();
            });

            window.addEventListener("click", function (event) {
                if (shoppingCart.style.display === "block" && !shoppingCart.contains(event.target) && !cartIcon.contains(event.target)) {
                    shoppingCart.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>