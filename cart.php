<?php
include 'connectdb.php';
session_start();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

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
                <h1>CART</h1>
                <div class="breadcrumb">
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="cart.php">Menu &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Menu Cards -------------- -->

    <div id="menu" class="main-color1">
        <div class="cart-page-container">
            <div class="cart-page">
                <div class="cart-page-left">
                    <div class="cart-page-header">
                        <h1>YOUR CART</h1>
                        <p>TOTAL (<span>0</span> items) <span>price</span></p>
                        <p>Your order isn't reserved yet.</p>
                    </div>
                    <div class="cart-page-items-list" id="cart-page-items-list">
                        <!-- ajax/cart-page/fetch_cart.php -->
                    </div>
                </div>
                <div class="cart-page-right">
                    <div class="cart-page-checkout-btn" onclick="location.href='checkout_page.php';">
                        <button>Checkout</button>
                        <span class="checkout-arrow">→</span>
                    </div>

                    <div class="cart-page-order-summary">
                        <h3>Order Summary</h3>
                        <p class="cart-page-row-spacebetween"><span>0 items</span><span>$<span>0.00</span></span></p>
                        <p class="cart-page-row-spacebetween"><span>Delivery</span><span>Free</span></p>
                        <p class="cart-page-row-spacebetween"><span>Tax</span><span>$<span>0.00</span></span></p>
                        <p class="cart-page-row-spacebetween"><span>Total</span><span>$<span>0.00</span></span></p>
                    </div>
                    <div class="cart-page-payment-method">
                        <h4>Available Payment Methods</h4>
                        <div class="cart-page-row">
                            <img src="images/assets/accepted-payment-methods/visa.svg" alt="Visa"
                                class="payment-method-icon" />
                            <img src="images/assets/accepted-payment-methods/paypal.svg" alt="PayPal"
                                class="payment-method-icon" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart-page-empty">
                <h1>Cart is empty</h1>

            </div>
        </div>
    </div>

    <?php
    include 'components/footer.php';
    ?>

    <script>
        $(document).ready(function () {
            function refetchCart() {
                $.ajax({
                    url: 'ajax/cart-page/fetch_cart.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            $('#cart-page-items-list').html(data.cartHtml);
                        } else {
                            $('#cart-page-items-list').html('');
                        }
                        toggleCartVisibility();
                        $('.select2-dropdown').select2({
                            minimumResultsForSearch: Infinity,
                            dropdownAutoWidth: true,
                            width: '100%',
                            theme: 'custom-select2'
                        });
                    },
                    error: function () {
                        alert('Error fetching the cart items.');
                    }
                });
            }

            function toggleCartVisibility() {
                if ($('#cart-page-items-list').children().length === 0) {
                    $('.cart-page').hide();
                    $('.cart-page-empty').show();
                } else {
                    $('.cart-page').show();
                    $('.cart-page-empty').hide();
                }
            }

            refetchCart();

            $(document).on('click', '.remove-btn', function () {
                var productId = $(this).data('product-id');
                var itemRow = $(this).closest('.cart-page-item');

                $.ajax({
                    url: 'ajax/cart-page/remove_from_cart.php',
                    type: 'POST',
                    data: { product_id: productId },
                    success: function (response) {
                        var data = JSON.parse(response);

                        if (data.success) {
                            itemRow.addClass('fade-out');
                            setTimeout(function () {
                                refetchCart();
                            }, 500);
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
                                title: (data.message)
                            });
                            refetchCart();
                        }
                    },
                    error: function () {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: "top-end",
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        });
                        Toast.fire({
                            icon: "error",
                            title: "Error processing the request."
                        });
                        refetchCart();
                    }
                });
            });
        });

    </script>

</body>

</html>