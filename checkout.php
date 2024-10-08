<div?php include 'connectdb.php' ; session_start(); ?>

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
                        <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="checkout.php">Checkout &gt;</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- -------------- Menu Cards -------------- -->

        <div id="menu" class="main-color1">
            <div class="container2">
                <div class="checkout-page-main">
                    <h1>Checkout</h1>
                    <p>
                        <span class="m-r-10">(<span class="cart-page-item-count">0</span> items)</span> <span>$<span
                                class="cart-page-total-price">0.00</span></span>
                    </p>
                    <div class="checkout-page">
                        <div class="checkout-page-left">

                            <div class="checkout-page-billing">
                                <h3>Billing Details</h3>
                                <div class="billing-details-form">
                                    <div class="billing-form-row">
                                        <div class="billing-form-group">
                                            <div class="entryarea">
                                                <input type="text" id="first-name" name="first_name" required>
                                                <div class="labelline">First Name *</div>
                                            </div>
                                        </div>
                                        <div class="billing-form-group">
                                            <div class="entryarea">
                                                <input type="text" id="last-name" name="last_name" required>
                                                <div class="labelline">Last Name *</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="address-1" name="address_1" required>
                                            <div class="labelline">Address 1 *</div>
                                        </div>
                                        <small>Street name and number</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="address-2" name="address_2">
                                            <div class="labelline">Address 2 (optional)</div>
                                        </div>
                                        <small>Additional address information</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="city" name="city" required>
                                            <div class="labelline">City *</div>
                                        </div>
                                        <small>Select your nearest city</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="phone-number" name="phone_number" required>
                                            <div class="labelline">Phone Number *</div>
                                        </div>
                                        <small id="phoneNumberText">Phone Number should be 10 digits</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="email" id="email" name="email" required>
                                            <div class="labelline">Email *</div>
                                        </div>
                                        <small id="emailText1"></small>
                                        <small id="emailText2">Example: abc@example.com</small>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-page-section-divider"></div>

                            <div class="checkout-page-billing">
                                <h3>Who are we delivering to?</h3>
                                <div class="form-group-checkbox">
                                    <input type="checkbox" name="deliverySender" id="deliverySender"
                                        class="custom-checkbox" checked>
                                    <label for="deliverySender" class="custom-checkbox-label">
                                        Same as billing address
                                    </label>
                                </div>

                                <!-- billing form if user untick deliverySender label -->
                                <div id="delivery-details-form" class="billing-details-form" style="display: none;">
                                    <div class="billing-form-row">
                                        <div class="billing-form-group">
                                            <div class="entryarea">
                                                <input type="text" id="delivery-first-name" name="delivery_first_name"
                                                    required>
                                                <div class="labelline">First Name *</div>
                                            </div>
                                        </div>
                                        <div class="billing-form-group">
                                            <div class="entryarea">
                                                <input type="text" id="delivery-last-name" name="delivery_last_name"
                                                    required>
                                                <div class="labelline">Last Name *</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="delivery-address-1" name="delivery_address_1"
                                                required>
                                            <div class="labelline">Address 1 *</div>
                                        </div>
                                        <small>Street name and number</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="delivery-address-2" name="delivery_address_2">
                                            <div class="labelline">Address 2 (optional)</div>
                                        </div>
                                        <small>Additional address information</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="delivery-city" name="delivery_city" required>
                                            <div class="labelline">City *</div>
                                        </div>
                                        <small>Select your nearest city</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="text" id="delivery-phone-number" name="delivery_phone_number"
                                                required>
                                            <div class="labelline">Phone Number *</div>
                                        </div>
                                        <small id="deliveryPhoneNumberText">Phone Number should be 10 digits</small>
                                    </div>

                                    <div class="billing-form-group-full">
                                        <div class="entryarea">
                                            <input type="email" id="delivery-email" name="delivery_email" required>
                                            <div class="labelline">Email *</div>
                                        </div>
                                        <small id="deliveryEmailText">Example: abc@example.com</small>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-page-section-divider"></div>

                            <div class="checkout-page-shipping">
                                <h3>Shipping Options</h3>
                                <div class="checkout-page-shipping-container delivery-option"
                                    onclick="selectOption('delivery')">
                                    <div class="checkout-page-shipping-option">
                                        <p>Delivery</p>
                                        <p>$<span class="cart-page-delivery-fee"></span></p>
                                        <p>Deliver at your doorstep via Outer Clove Delivery!</p>
                                    </div>
                                    <div class="checkout-page-shipping-option-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="#000000">
                                            <path
                                                d="M240-192q-50 0-85-35t-35-85H48v-408q0-29.7 21.15-50.85Q90.3-792 120-792h552v144h120l120 168v168h-72q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-72q20.4 0 34.2-13.8Q288-291.6 288-312q0-20.4-13.8-34.2Q260.4-360 240-360q-20.4 0-34.2 13.8Q192-332.4 192-312q0 20.4 13.8 34.2Q219.6-264 240-264ZM120-384h24q17-23 42-35.5t54-12.5q29 0 54 12.5t41.53 35.5H600v-336H120v336Zm600 120q20.4 0 34.2-13.8Q768-291.6 768-312q0-20.4-13.8-34.2Q740.4-360 720-360q-20.4 0-34.2 13.8Q672-332.4 672-312q0 20.4 13.8 34.2Q699.6-264 720-264Zm-48-192 168-1-85-119h-83v120Zm-310-93Z" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="checkout-page-shipping-container pickup-option"
                                    onclick="selectOption('pickup')">
                                    <div class="checkout-page-shipping-option">
                                        <p>Pickup</p>
                                        <p><span class="checkout-page-delivery-fee">Free</span></p>
                                        <p>Visit Outer Clove Restaurant & Pickup your order!</p>
                                    </div>
                                    <div class="checkout-page-shipping-option-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 -960 960 960"
                                            width="20px" fill="#000000">
                                            <path
                                                d="M165-733v-60h632v60H165Zm5 567v-245h-49v-60l44-202h631l44 202v60h-49v245h-60v-245H552v245H170Zm60-60h262v-185H230v185Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-page-section-divider"></div>

                            <!-- Delivery Option Selected -->
                            <div id="delivery-selected" style="display:none;">
                                <div class="checkout-page-shipping-option-section">
                                    <h3>Delivery Options</h3>
                                    <div class="checkout-page-shipping-option-container">
                                        <div class="checkout-page-shipping-option-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="21px"
                                                viewBox="0 -960 960 960" width="21px" fill="#000000">
                                                <path
                                                    d="M48-192v-72h240v-72H96v-72h192v-72H144v-72h144v-120l-76-161 65-31 91 192h416l-76-161 66-31 90 192v480H48Zm468-264h120q15.3 0 25.65-10.29Q672-476.58 672-491.79t-10.35-25.71Q651.3-528 636-528H516q-15.3 0-25.65 10.29Q480-507.42 480-492.21t10.35 25.71Q500.7-456 516-456ZM360-264h432v-336H360v336Zm0 0v-336 336Z" />
                                            </svg>
                                        </div>
                                        <div class="checkout-page-shipping-option-text">
                                            <p>Now</p>
                                            <p>Deliver in 30-40 min</p>
                                        </div>
                                    </div>
                                    <div class="checkout-page-shipping-option-container">
                                        <div class="checkout-page-shipping-option-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                viewBox="0 -960 960 960" width="20px" fill="#000000">
                                                <path
                                                    d="M444-384v-72h72v72h-72Zm-156 0v-72h72v72h-72Zm312 0v-72h72v72h-72ZM444-240v-72h72v72h-72Zm-156 0v-72h72v72h-72Zm312 0v-72h72v72h-72ZM144-96v-672h144v-96h72v96h240v-96h72v96h144v672H144Zm72-72h528v-360H216v360Zm0-432h528v-96H216v96Zm0 0v-96 96Z" />
                                            </svg>
                                        </div>
                                        <div class="checkout-page-shipping-option-text">
                                            <p>Schedule</p>
                                            <p>Choose a date & time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pickup Option Selected -->
                            <div id="pickup-selected" style="display:none;">
                                <div class="checkout-page-shipping-option-section">
                                    <h3>Pickup Options</h3>
                                    <div class="checkout-page-shipping-option-container">
                                        <div class="checkout-page-shipping-option-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="21px"
                                                viewBox="0 -960 960 960" width="21px" fill="#000000">
                                                <path
                                                    d="M48-192v-72h240v-72H96v-72h192v-72H144v-72h144v-120l-76-161 65-31 91 192h416l-76-161 66-31 90 192v480H48Zm468-264h120q15.3 0 25.65-10.29Q672-476.58 672-491.79t-10.35-25.71Q651.3-528 636-528H516q-15.3 0-25.65 10.29Q480-507.42 480-492.21t10.35 25.71Q500.7-456 516-456ZM360-264h432v-336H360v336Zm0 0v-336 336Z" />
                                            </svg>
                                        </div>
                                        <div class="checkout-page-shipping-option-text">
                                            <p>Now</p>
                                            <p>Order will be ready in 15 min</p>
                                        </div>
                                    </div>
                                    <div class="checkout-page-shipping-option-container">
                                        <div class="checkout-page-shipping-option-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                viewBox="0 -960 960 960" width="20px" fill="#000000">
                                                <path
                                                    d="M444-384v-72h72v72h-72Zm-156 0v-72h72v72h-72Zm312 0v-72h72v72h-72ZM444-240v-72h72v72h-72Zm-156 0v-72h72v72h-72Zm312 0v-72h72v72h-72ZM144-96v-672h144v-96h72v96h240v-96h72v96h144v672H144Zm72-72h528v-360H216v360Zm0-432h528v-96H216v96Zm0 0v-96 96Z" />
                                            </svg>
                                        </div>
                                        <div class="checkout-page-shipping-option-text">
                                            <p>Schedule</p>
                                            <p>Choose a date & time</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-page-section-divider"></div>
                            <div class="checkout-page-payment">
                                <h3>How would you like to pay?</h3>
                                <div class="checkout-page-payment-container">
                                    <div class="checkout-page-payment-row">
                                        <div class="checkout-page-payment-card">
                                            <p>Visa</p>
                                        </div>
                                        <div class="checkout-page-payment-images">
                                            <img src="images/assets/accepted-payment-methods/visa.svg" alt="Visa"
                                                class="checkout-page-payment-svg">
                                        </div>
                                    </div>
                                </div>

                                <div class="checkout-page-payment-container">
                                    <div class="checkout-page-payment-row">
                                        <div class="checkout-page-payment-card">
                                            <p>Paypal</p>
                                        </div>
                                        <div class="checkout-page-payment-images">
                                            <img src="images/assets/accepted-payment-methods/paypal.svg" alt="Paypal"
                                                class="checkout-page-payment-svg paypal-svg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="place-order">
                                <div class="form-group-checkbox">
                                    <input type="checkbox" name="agreement.accept" id="agreementAccept"
                                        class="custom-checkbox">
                                    <label for="agreementAccept" class="custom-checkbox-label">
                                        I have read and agreed to the terms and conditions
                                    </label>
                                </div>
                                <div class="placeOrder-btn" onclick="location.href='';">
                                    <button>Place Order</button>
                                    <span class="placeOrder-arrow">→</span>
                                </div>
                            </div>
                        </div>
                        <div class="checkout-page-right">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                viewBox="0 -960 960 960" width="20px" fill="#000000">
                                                <path
                                                    d="M224.12-161q-49.12 0-83.62-34.42Q106-229.83 106-279H40v-461q0-24 18-42t42-18h579v167h105l136 181v173h-71q0 49.17-34.38 83.58Q780.24-161 731.12-161t-83.62-34.42Q613-229.83 613-279H342q0 49-34.38 83.5t-83.5 34.5Zm-.12-60q24 0 41-17t17-41q0-24-17-41t-41-17q-24 0-41 17t-17 41q0 24 17 41t41 17Zm507 0q24 0 41-17t17-41q0-24-17-41t-41-17q-24 0-41 17t-17 41q0 24 17 41t41 17Zm-52-204h186L754-573h-75v148Z" />
                                            </svg>
                                            Delivery
                                        </label>
                                        <span>$<span class="cart-page-delivery-fee">0.00</span></span>
                                    </p>
                                    <p class="cart-page-row-spacebetween">
                                        <label>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px"
                                                viewBox="0 -960 960 960" width="20px" fill="#000000">
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
                                            <svg xmlns="http://www.w3.org/2000/svg" height="15px"
                                                viewBox="0 -960 960 960" width="15px" fill="#000000">
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
                            <div class="checkout-page-section-divider"></div>
                            <div class="checkout-page-items-list" id="checkout-page-items-list">
                                <!-- ajax/checkout-page/fetch_checkout_cart.php -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include 'components/footer.php';
        ?>

        <script>
            let deliveryTotal, pickupTotal;
            $(document).ready(function () {


                function refetchCart() {
                    $.ajax({
                        url: 'ajax/checkout-page/fetch_checkout_cart.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            if (data.success) {
                                $('#checkout-page-items-list').html(data.cartHtml);
                                $('.cart-page-item-count').text(data.itemCount);
                                $('.cart-page-total-price').text(data.totalPrice);
                                $('.cart-page-delivery-fee').text(data.deliveryFee);
                                $('.cart-page-tax').text(data.tax);


                                deliveryTotal = data.finalTotalDelivery;
                                pickupTotal = data.finalTotalPickup;

                                $('.cart-page-final-total').text(pickupTotal);


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

                            } else {
                                $('#checkout-page-items-list').html('');
                                $('.item-count span').text('0');
                                $('.total-price span').text('0.00');
                            }
                            toggleCartVisibility();
                        },
                        error: function () {
                            alert('Error fetching the cart items.');
                        }
                    });
                }

                function toggleCartVisibility() {
                    if ($('#checkout-page-items-list').children().length === 0) {
                        $('.checkout-page-main').hide();
                        $('.checkout-page-empty').show();
                    } else {
                        $('.checkout-page-main').show();
                        $('.checkout-page-empty').hide();
                    }
                }

                refetchCart();

                // billing details form
                document.querySelectorAll('.entryarea input').forEach(function (input) {
                    if (input.value) {
                        input.classList.add('has-value');
                    }

                    input.addEventListener('input', function () {
                        if (input.value) {
                            input.classList.add('has-value');
                            input.classList.remove('error');
                        } else {
                            input.classList.remove('has-value');
                        }

                        // phone number validation
                        if (input.id === 'phone-number') {
                            this.value = this.value.replace(/\D/g, '');
                            if (this.value.length > 10) {
                                this.value = this.value.slice(0, 10);
                            }

                            const phoneNumberText = document.getElementById('phoneNumberText');
                            if (this.value.length < 10) {
                                phoneNumberText.classList.add('error-text-color');
                                this.classList.add('error');
                            } else {
                                phoneNumberText.classList.remove('error-text-color');
                            }
                        }

                        // Email validation
                        if (input.id === 'email') {
                            const emailText1 = document.getElementById('emailText1');
                            const emailText2 = document.getElementById('emailText2');
                            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (this.value && !emailPattern.test(this.value)) {
                                emailText1.textContent = "Please check your email address is correct";
                                emailText1.classList.add('error-text-color');
                                emailText2.classList.add('error-text-color');
                                this.classList.add('error');
                            } else {
                                emailText1.textContent = "";
                                emailText1.classList.remove('error-text-color');
                                emailText2.classList.remove('error-text-color');
                                this.classList.remove('error');
                            }
                        }
                    });

                    input.addEventListener('blur', function () {
                        if (input.value) {
                            input.classList.add('has-value');
                            // input.classList.remove('error');
                        } else {
                            input.classList.remove('has-value');
                            if (input.hasAttribute('required')) {
                                input.classList.add('error');
                            }
                        }
                    });

                    // input.addEventListener('focus', function () {
                    //     input.classList.remove('error');
                    // });

                });

                // deliverySender tick/untick procedure
                document.getElementById('deliverySender').addEventListener('change', function () {
                    const deliveryForm = document.getElementById('delivery-details-form');

                    if (this.checked) {
                        deliveryForm.style.display = 'none';

                        document.getElementById('delivery-first-name').value = document.getElementById('first-name').value;
                        document.getElementById('delivery-last-name').value = document.getElementById('last-name').value;
                        document.getElementById('delivery-address-1').value = document.getElementById('address-1').value;
                        document.getElementById('delivery-address-2').value = document.getElementById('address-2').value;
                        document.getElementById('delivery-city').value = document.getElementById('city').value;
                        document.getElementById('delivery-phone-number').value = document.getElementById('phone-number').value;
                        document.getElementById('delivery-email').value = document.getElementById('email').value;
                    } else {
                        deliveryForm.style.display = 'block';

                        document.getElementById('delivery-first-name').value = '';
                        document.getElementById('delivery-last-name').value = '';
                        document.getElementById('delivery-address-1').value = '';
                        document.getElementById('delivery-address-2').value = '';
                        document.getElementById('delivery-city').value = '';
                        document.getElementById('delivery-phone-number').value = '';
                        document.getElementById('delivery-email').value = '';
                    }
                });



                window.selectOption = function (option) {
                    // Hide both sections initially
                    $('#delivery-selected').hide();
                    $('#pickup-selected').hide();

                    // Show the selected section and update the total
                    if (option === 'delivery') {
                        $('#delivery-selected').show();
                        $('.cart-page-final-total').text(deliveryTotal); // Update final total for delivery
                        $('.delivery-option').addClass('selected');
                        $('.pickup-option').removeClass('selected');
                    } else if (option === 'pickup') {
                        $('#pickup-selected').show();
                        $('.cart-page-final-total').text(pickupTotal); // Update final total for pickup
                        $('.pickup-option').addClass('selected');
                        $('.delivery-option').removeClass('selected');
                    }
                };


            });

        </script>

    </body>

    </html>