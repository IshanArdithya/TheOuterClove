<!-- -------------- Navigation Bar -------------- -->

<header id="header" class="headerss">
    <a class="navbar-logo" href="/TheOuterClove/index.php">The Outer <span class="theme-accent-color">Clove</span></a>

    <nav class="navbar">
        <a href="reservations.php">Reservations</a>
        <a href="products.php">Products</a>
        <a href="inquiries.php">Inquiries</a>
        <a href="feedbacks.php">Feedbacks</a>
        <?php if (isset($_SESSION['user']) && ($_SESSION['user']['role'] === 'admin' || $_SESSION['user']['role'] === 'manager')): ?>
            <a href="customers.php">Customers</a>
            <a href="staffusers.php">Staff Users</a>
        <?php endif; ?>
    </nav>

    <div class="icons">
        <div class="icons hideit">
            <a href="" class="material-symbols-outlined">search</a>
        </div>

        <div class="icons hideit">
            <a href="" class="material-symbols-outlined">shopping_cart</a>
        </div>

        <div class="icons" id="account-icon">
            <a href="/TheOuterClove/index.php" class="material-symbols-outlined">home</a>
        </div>
    </div>
</header>

<style>
    .headerss {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        /* padding: 30px 200px; */
        padding: 4vh 25vh;
        background: transparent;
        display: flex;
        justify-content: space-between;
        align-items: center;
        z-index: 100;
        transition: background 0.5s ease-in-out;
    }
</style>