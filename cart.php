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
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://unpkg.com/tippy.js@6.3.1/dist/tippy-bundle.umd.min.js"></script>


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
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="cart.php">Cart &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Menu Cards -------------- -->

    <div id="menu" class="main-color1">
        <div class="container2">
            <div class="cart-page">
                <div class="cart-page-left">
                    <div class="cart-page-header">
                        <h1>YOUR CART</h1>
                        <p>TOTAL (<span class="cart-page-item-count">0</span> items) $<span
                                class="cart-page-total-price">price</span></p>
                        <p>Your order isn't reserved yet. Checkout to confirm your order.</p>
                    </div>
                    <div class="cart-page-items-list" id="cart-page-items-list">
                        <!-- ajax/cart-page/fetch_cart.php -->
                    </div>
                </div>
                <div class="cart-page-right">
                    <div class="cart-page-checkout-btn" onclick="location.href='checkout.php';">
                        <button>Checkout</button>
                        <span class="checkout-arrow">→</span>
                    </div>

                    <div class="cart-page-order-summary">
                        <h3>Order Summary</h3>
                        <p class="cart-page-row-spacebetween">
                            <span><span class="cart-page-item-count">0</span> items</span>
                            <span>$<span class="cart-page-total-price">0.00</span></span>
                        </p>
                        <p class="cart-page-row-spacebetween"><span>Shipping</span>
                        </p>

                        <div class="cart-page-delivery-options">
                            <p class="cart-page-row-spacebetween">
                                <label>
                                    <input type="radio" name="deliveryOption" value="delivery" checked>
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#000000">
                                        <path
                                            d="M224.12-161q-49.12 0-83.62-34.42Q106-229.83 106-279H40v-461q0-24 18-42t42-18h579v167h105l136 181v173h-71q0 49.17-34.38 83.58Q780.24-161 731.12-161t-83.62-34.42Q613-229.83 613-279H342q0 49-34.38 83.5t-83.5 34.5Zm-.12-60q24 0 41-17t17-41q0-24-17-41t-41-17q-24 0-41 17t-17 41q0 24 17 41t41 17Zm507 0q24 0 41-17t17-41q0-24-17-41t-41-17q-24 0-41 17t-17 41q0 24 17 41t41 17Zm-52-204h186L754-573h-75v148Z" />
                                    </svg>
                                    Delivery
                                </label>
                                <span>$<span class="cart-page-delivery-fee">0.00</span></span>
                            </p>
                            <p class="cart-page-row-spacebetween">
                                <label>
                                    <input type="radio" name="deliveryOption" value="pickup">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                        width="20px" fill="#000000">
                                        <path
                                            d="M165-733v-60h632v60H165Zm5 567v-245h-49v-60l44-202h631l44 202v60h-49v245h-60v-245H552v245H170Zm60-60h262v-185H230v185Z" />
                                    </svg>
                                    Pickup
                                </label>
                                <span>Free</span>
                            </p>
                        </div>


                        <p class="cart-page-row-spacebetween">
                            <span>Tax
                                <!-- contents in tippy.js script. tax-info -->
                                <span class="tax-info" data-tippy-content="">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 -960 960 960"
                                        width="15px" fill="#000000">
                                        <path
                                            d="M444-288h72v-240h-72v240Zm35.79-312q15.21 0 25.71-10.29t10.5-25.5q0-15.21-10.29-25.71t-25.5-10.5q-15.21 0-25.71 10.29t-10.5 25.5q0 15.21 10.29 25.71t25.5 10.5Zm.49 504Q401-96 331-126t-122.5-82.5Q156-261 126-330.96t-30-149.5Q96-560 126-629.5q30-69.5 82.5-122T330.96-834q69.96-30 149.5-30t149.04 30q69.5 30 122 82.5T834-629.28q30 69.73 30 149Q864-401 834-331t-82.5 122.5Q699-156 629.28-126q-69.73 30-149 30Zm-.28-72q130 0 221-91t91-221q0-130-91-221t-221-91q-130 0-221 91t-91 221q0 130 91 221t221 91Zm0-312Z" />
                                    </svg>
                                </span>
                            </span>
                            <span>$<span class="cart-page-tax">0.00</span></span>
                        </p>


                        <p class="cart-page-row-spacebetween"><span>Total</span>
                            <span>$<span class="cart-page-final-total">0.00</span></span>
                        </p>

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
                <h1>Your Cart is empty</h1>
                <p>Your cart is waiting! Add something delicious and we’ll bring it right to you.</p>
                <div class="cart-page-empty-btn" onclick="location.href='menu.php';">
                    <button>Get Started</button>
                    <span class="cart-page-empty-btn-arrow">→</span>
                </div>
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
                            $('.cart-page-item-count').text(data.itemCount);
                            $('.cart-page-total-price').text(data.totalPrice);
                            $('.cart-page-delivery-fee').text(data.deliveryFee);
                            $('.cart-page-tax').text(data.tax);
                            $('.cart-page-final-total').text(data.finalTotalDelivery);

                            // based on default checked option
                            if ($('input[name="deliveryOption"]:checked').val() === 'delivery') {
                                $('.cart-page-final-total').text(data.finalTotalDelivery);
                            } else {
                                $('.cart-page-final-total').text(data.finalTotalPickup);
                            }

                            // tipppy.js - tax-info
                            tippy('.tax-info', {
                                content: `
                                <div>
                                    <strong>Tax Rate?</strong><br>
                                    <span class="tax-rate">${data.taxRate}</span><br>
                                    This is the tax amount based on the current tax rates.
                                </div>
                            `,
                                allowHTML: true,
                                interactive: true,
                                theme: 'light',
                            });

                            // final total changes when shipping option changes
                            $('input[name="deliveryOption"]').change(function () {
                                if ($(this).val() === 'delivery') {
                                    $('.cart-page-final-total').text(data.finalTotalDelivery);
                                } else {
                                    $('.cart-page-final-total').text(data.finalTotalPickup);
                                }
                            });

                        } else {
                            $('#cart-page-items-list').html('');
                            $('.item-count span').text('0');
                            $('.total-price span').text('0.00');
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

            $(document).on('change', '.cart-page-item-quantity', function () {
                var productId = $(this).data('product-id');
                var quantity = $(this).val();

                $.ajax({
                    url: 'ajax/cart-page/update_quantity.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function (data) {
                        if (data.success) {
                            refetchCart();
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Products Updated!"
                            });
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
                                title: data.message
                            });
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
                            title: "Could not update the quantity. Please try again."
                        });
                    }
                });
            });


        });

    </script>

</body>

</html>