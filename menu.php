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
    <script src="https://kit.fontawesome.com/be234dd9e9.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- -------------- Navigation Bar -------------- -->

    <?php
    include 'components/header.php';
    ?>

    <!-- -------------- Background Image & Texts -------------- -->

    <div id="pagetitle" class="pagetitle layout1"
        style="background-image: url(https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/uploads/2021/03/bg-page-title.jpg);">
        <div class="page-title-container">
            <div class="page-title-inner">
                <h1 class="page-title">Our Menu</h1>
                <ul class="page-title-breadcrumb">
                    <li>
                        <a class="breadcrumb-entry fa-solid fa-house" style="color: #fff;"></a>
                        <a href="http://localhost/TheOuterClove/index.php" class="breadcrumb-entry">Home</a>
                        <a class="breadcrumb-entry">/</a>
                        <a href="http://localhost/TheOuterClove/menu.php" class="breadcrumb-entry">Menu</a>
                    </li>
                </ul>
            </div>
            <div class="page-title-icon">
                <img src="https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/themes/cafenod/assets/images/coffe-icon.png"
                    alt="Menu">
            </div>
        </div>
    </div>

    <!-- -------------- Menu Cards -------------- -->

    <div id="menu" class="main-color1">
        <div class="heading-wrap">
            <h2 class="block-title">CHECK OUT WHAT'S <span class="theme-accent-color">COOKIN'</span></h2>
            <h3 class="mini-title">Discover delightful dishes at pocket-friendly prices!</h3>
        </div>

        <section id="products" class="products">
            <div class="menu-tabs">
                <ul class="tab-list">
                    <li><a href="#" class="tab-item active" data-category="all">All</a></li>
                    <li><a href="#" class="tab-item" data-category="starters">Starters</a></li>
                    <li><a href="#" class="tab-item" data-category="desserts">Desserts</a></li>
                </ul>
                <div class="tab-indicator"></div>
            </div>

            <div class="all-products" id="products-container">
                <!-- Products will be loaded here dynamically -->
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

            loadProducts('all');

            document.querySelectorAll('.tab-item').forEach(item => {
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    const category = this.getAttribute('data-category');
                    loadProducts(category);

                    document.querySelectorAll('.tab-item').forEach(tab => {
                        tab.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });

            function loadProducts(category) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'ajax/fetch_products.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (this.status === 200) {
                        document.getElementById('products-container').innerHTML = this.responseText;
                        attachAddToCartListeners();
                    }
                };
                xhr.send('category=' + category);
            }

            function attachAddToCartListeners() {
                const addToCartForms = document.querySelectorAll(".add-to-cart-form");

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
                                    localStorage.setItem('cartUpdated', Date.now());
                                    showToast("success", "Added to Cart");
                                    updateCartItems();
                                }
                            })
                            .catch(error => {
                                showToast("error", "Error adding to cart");
                            });
                    });
                });
            }

            function showToast(icon, title) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                Toast.fire({
                    icon: icon,
                    title: title
                });
            }

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

                                    localStorage.setItem('cartUpdated', Date.now());

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

    <script src="js/menu-page/tab-list-position.js"></script>

</body>

</html>