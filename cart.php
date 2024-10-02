<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Bag</title>
    <link rel="stylesheet" href="dashboard_style.css">
</head>
<body>

<div class="cart-container">
    <h1 class="cart-title">YOUR BAG</h1>
    <div class="cart-total">
        <p>Total (2 items) <span>$348</span></p>
        <p>Items in your bag are not reserved — check out now to make them yours.</p>
    </div>

    <div class="promo-banner">
        <p>ADICLUB DAYS ARE HERE</p>
        <p>Unlock your adiClub points & discover the best of adidas now! Not a member yet?</p>
        <a href="#" class="join-club">JOIN THE CLUB</a>
    </div>

    <div class="cart-items">
        <div class="cart-item">
            <img src="samba-og-shoes.png" alt="Samba OG Shoes">
            <div class="item-details">
                <h2>SAMBA OG SHOES</h2>
                <p>Cloud White / Core Black / Clear Granite</p>
                <p>Size: 6.5 UK</p>
                <div class="item-quantity">
                    <select>
                        <option value="1">1</option>
                    </select>
                </div>
                <button class="remove-item">×</button>
            </div>
        </div>

        <div class="cart-item">
            <img src="japan-shoes.png" alt="Japan Shoes">
            <div class="item-details">
                <h2>JAPAN SHOES</h2>
                <p>Mineral Green / Crystal Sand / Wonder White</p>
                <p>Size: 3.5 UK</p>
                <div class="item-quantity">
                    <select>
                        <option value="1">1</option>
                    </select>
                </div>
                <button class="remove-item">×</button>
            </div>
        </div>
    </div>

    <div class="checkout-section">
        <button class="checkout-btn">CHECKOUT</button>

        <div class="order-summary">
            <h2>ORDER SUMMARY</h2>
            <p>2 items <span>$348.00</span></p>
            <p>Delivery <span>Free</span></p>
            <p>Total <span>$348.00</span></p>
            <p class="inclusive-tax">(Inclusive of tax $28.73)</p>
        </div>
    </div>
</div>

</body>
</html>
