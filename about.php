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
        style="background-image: url(https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/uploads/2021/03/bg-page-title.jpg);">
        <div class="page-title-container">
            <div class="page-title-inner">
                <h1 class="page-title">About Us</h1>
                <ul class="page-title-breadcrumb">
                    <li>
                        <a class="breadcrumb-entry fa-solid fa-house" style="color: #fff;"></a>
                        <a href="http://localhost/TheOuterClove/index.php" class="breadcrumb-entry">Home</a>
                        <a class="breadcrumb-entry">/</a>
                        <a href="http://localhost/TheOuterClove/about.php" class="breadcrumb-entry">About</a>
                    </li>
                </ul>
            </div>
            <div class="page-title-icon">
                <img src="images/assets/restaurant.png" alt="Menu">
            </div>
        </div>
    </div>

    <!-- -------------- About -------------- -->

    <div id="first-section">
        <div id="about" class="main-color1">
            <div class="main-container">
                <div class="about-whyus">
                    <img src="https://placehold.co/500x500" alt="Our Unique Dining Experience" class="whyus-image">
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

                <div class="statistics-container">
                    <div class="statistic">
                        <div class="statistic-title">10</div>
                        <div class="statistic-text">Years of Experience</div>
                    </div>

                    <div class="statistic">
                        <div class="statistic-title">100</div>
                        <div class="statistic-text">Tasty Dishes</div>
                    </div>

                    <div class="statistic">
                        <div class="statistic-title">50</div>
                        <div class="statistic-text">Staff</div>
                    </div>

                    <div class="statistic">
                        <div class="statistic-title">12,000</div>
                        <div class="statistic-text">Happy Customers</div>
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

</body>

</html>