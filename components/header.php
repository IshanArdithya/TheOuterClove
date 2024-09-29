<header id="header" class="header">
        <a class="navbar-logo" href="index.php">The Outer <span class="theme-accent-color">Clove</span></a>

        <nav class="navbar">
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" id="homebutton" href="index.php">Home</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'menu.php') ? 'active' : ''; ?>" href="menu.php">Menu</a>
            <a id="gallerybutton" href="index.php#gallery">Gallery</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'reservations.php') ? 'active' : ''; ?>" href="reservations.php">Reservation</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>" href="about.php">About</a>
            <a class="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>" href="contact.php">Contact Us</a>
        </nav>

        <div class="icons">
            <div class="icons hideit">
                <a href="p1.html" class="material-symbols-outlined">search</a>
            </div>
          
            <div class="icons <?php echo (basename($_SERVER['PHP_SELF']) !== 'menu.php') ? 'hideit' : ''; ?>" id="shopping-icon">
                <a class="material-symbols-outlined">shopping_cart</a>
            </div>
          
            <div class="icons" id="account-icon">
                <a href="login.php" class="material-symbols-outlined">account_circle</a>
            </div>
        </div>
        

    </header>