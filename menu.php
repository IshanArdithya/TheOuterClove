<?php
include 'connectdb.php';

session_start();

$cartItems = [];

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <!-- -------------- Navigation Bar -------------- -->

    <?php
    include 'components/header.php';
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
            <form id="search-form" method="get" class="search-form">
                <input type="text" name="search" id="search-input" placeholder="Search...">
            </form>
            <div class="all-products" id="products-container">
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
                                <form id="add-to-cart-form-<?php echo $row['product_id']; ?>" class="add-to-cart-form" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
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

            const searchInput = document.getElementById("search-input");
            const productsContainer = document.getElementById("products-container");

            searchInput.addEventListener("input", function () {
                const searchQuery = searchInput.value;

                fetch('ajax/search_products.php?search=' + encodeURIComponent(searchQuery))
                    .then(response => response.text())
                    .then(data => {
                        productsContainer.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error fetching search results:', error);
                    });
            });


            addToCartForms.forEach(function (form) {
                form.addEventListener("submit", function (event) {
                    event.preventDefault();

                    const formData = new FormData(this);

                    fetch('ajax/add_to_cart.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true
                                });
                                Toast.fire({
                                    icon: "success",
                                    title: "Added to Cart"
                                });

                                updateCartItems();
                            }
                        })
                        .catch(error => {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Error adding to cart"
                            });
                        });
                });
            });

            function updateCartItems() {
                fetch('ajax/fetch_cart.php')
                    .then(response => response.json())
                    .then(data => {
                        const cartItemsContainer = document.getElementById('cart-items');
                        const cartButton = document.querySelector('.popup-cart-btn');
                        const checkoutButton = document.querySelector('.popup-checkout-btn');

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
                                    <form class="remove-from-cart-form" method="post">
                                        <input type="hidden" name="product_id" value="${item.id}">
                                        <input type="hidden" name="remove_from_cart" value="1"> <!-- Hidden field for remove action -->
                                        <button type="submit" name="remove_from_cart" class="popup-cart-remove-btn">×</button>
                                    </form>

                                `;
                                cartItemsContainer.appendChild(cartItem);
                            });

                            cartButton.classList.remove('disabled');
                            checkoutButton.classList.remove('disabled');

                            bindRemoveFromCartButtons();
                        } else {
                            cartItemsContainer.innerHTML = '<p class="popup-cart-empty">Your cart is empty</p>';

                            cartButton.classList.add('disabled');
                            checkoutButton.classList.add('disabled');
                        }
                    })
                    .catch(error => console.error('Error fetching cart items:', error));
            }

            function bindRemoveFromCartButtons() {
                const removeFromCartForms = document.querySelectorAll(".remove-from-cart-form");

                removeFromCartForms.forEach(function (form) {
                    form.addEventListener("submit", function (event) {
                        event.preventDefault();

                        const formData = new FormData(this);

                        fetch('ajax/remove_cart.php', {
                            method: 'POST',
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true
                                    });
                                    Toast.fire({
                                        icon: "success",
                                        title: "Removed from Cart"
                                    });

                                    updateCartItems();
                                } else {

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 1500,
                                        timerProgressBar: true
                                    });

                                    Toast.fire({
                                        icon: "error",
                                        title: "Product not found in Cart"
                                    });

                                    updateCartItems();
                                }
                            })
                            .catch(error => {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 1500,
                                    timerProgressBar: true
                                });
                                Toast.fire({
                                    icon: "error",
                                    title: "Error removing from Cart"
                                });

                                updateCartItems();
                            });
                    });
                });
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