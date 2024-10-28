<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://kit.fontawesome.com/be234dd9e9.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">

</head>

<body>

    <!-- -------------- Navigation Bar -------------- -->

    <?php
    include 'components/header.php'
        ?>

    <!-- -------------- Scroll to Top -------------- -->

    <button id="scrollToTop" class="scroll-to-top">
        <i class="fas fa-angle-up"></i>
    </button>

    <!-- -------------- Background Image & Texts -------------- -->

    <div id="pagetitle" class="pagetitle layout1"
        style="background-image: url(images/assets/restaurant-foods.jpg);">
        <div class="page-title-container">
            <div class="page-title-inner">
                <h1 class="page-title">About Us</h1>
                <ul class="page-title-breadcrumb">
                    <li>
                        <a class="breadcrumb-entry fa-solid fa-house" style="color: #fff;"></a>
                        <a href="index.php" class="breadcrumb-entry">Home</a>
                        <a class="breadcrumb-entry">/</a>
                        <a href="about.php" class="breadcrumb-entry">About</a>
                    </li>
                </ul>
            </div>
            <div class="page-title-icon">
                <img src="images/assets/restaurant.png" alt="Menu">
            </div>
        </div>
    </div>

    <!-- -------------- About -------------- -->

    <div id="first-section" class="about-section">
        <div id="about" class="main-color2 scroll">
            <div class="main-container">
                <div class="about-whyus">
                    <img src="images/gallery/restaurant.jpg" alt="Our Unique Dining Experience" class="whyus-image">
                    <div class="whyus-content">
                        <h2 class="whyus-title">Why Outer Clove?</h2>
                        <p class="whyus-description">
                            At The Outer Clove, we blend Sri Lankan tradition and innovation to bring you a truly unique
                            dining experience. Drawing on the rich culture and landscapes of Sri Lanka, our dishes are
                            crafted from the freshest local ingredients, sourced seasonally from nearby farms and
                            coastlines.
                            <br>
                            Our goal is to offer more than a meal—we want to transport you to the warmth of a Sri Lankan
                            home, where every dish celebrates taste, history, and togetherness. From the bold spices of
                            our signature curries to the refreshing simplicity of coconut-infused flavors, we honor
                            tradition with a modern twist.
                            <br>
                            Step into a space inspired by the elegance of an old-world Sri Lankan manor, where colonial
                            charm meets modern sophistication. Each visit is an invitation to relax, savor, and feel at
                            home. Thank you for joining us on this journey to share the vibrant flavors of Sri Lanka,
                            one dish at a time.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="about" class="main-color2 scroll">
            <div class="main-container">
                <div class="about-features">
                    <div class="about-feature-item">
                        <div class="about-icon-container">
                            <i class="fas fa-coffee"></i>
                        </div>
                        <h3 class="about-feature-title">EXQUISITE FLAVORS</h3>
                        <p class="about-feature-description">Savor the rich and diverse flavors of our signature dishes,
                            crafted from fresh, locally sourced ingredients</p>
                    </div>
                    <div class="about-feature-item">
                        <div class="about-icon-container">
                            <i class="fas fa-star"></i>
                        </div>
                        <h3 class="about-feature-title">UNCOMPROMISING QUALITY</h3>
                        <p class="about-feature-description">We take pride in our commitment to quality, ensuring each
                            dish is made with the finest ingredients for an unforgettable dining experience</p>
                    </div>
                    <div class="about-feature-item">
                        <div class="about-icon-container">
                            <i class="fas fa-leaf"></i>
                        </div>
                        <h3 class="about-feature-title">NATURAL GOODNESS</h3>
                        <p class="about-feature-description">Our menu features wholesome options, celebrating the
                            natural flavors and health benefits of fresh, seasonal produce</p>
                    </div>
                    <div class="about-feature-item">
                        <div class="about-icon-container">
                            <i class="fas fa-fire"></i>
                        </div>
                        <h3 class="about-feature-title">MASTERFUL PREPARATION</h3>
                        <p class="about-feature-description">Experience the art of cooking with our skilled chefs, who
                            expertly prepare each dish to perfection, enhancing every flavor</p>
                    </div>
                </div>
            </div>
        </div>
        <div id="about" class="main-color2 scroll">
            <div class="main-container">
                <div class="statistics-container" id="statistics">
                    <div class="statistic">
                        <div class="statistic-title" data-count="10">0</div>
                        <div class="statistic-text">Years of Experience</div>
                    </div>

                    <div class="statistic">
                        <div class="statistic-title" data-count="50">0</div>
                        <div class="statistic-text">Dishes</div>
                    </div>

                    <div class="statistic">
                        <div class="statistic-title" data-count="5000">0</div>
                        <div class="statistic-text">Orders</div>
                    </div>

                    <div class="statistic">
                        <div class="statistic-title" data-count="5000">0</div>
                        <div class="statistic-text">Customers</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Footer -------------- -->

    <?php
    include 'components/footer.php';
    ?>

    <script src="js/header.js"></script>
    <script src="js/scroll-to-top.js"></script>
    <script src="js/about-page/statistic-count.js"></script>
    <script src="js/fade-in.js"></script>

</body>

</html>