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
                <img src="https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/themes/cafenod/assets/images/coffe-icon.png"
                    alt="Menu">
            </div>
        </div>
    </div>

    <!-- -------------- About -------------- -->

    <div id="about" class="main-color1">
        <p>Welcome to The Outer Clove Restaurant, where the love for good food and warm hospitality has been our recipe
            for success since 2002. We believe in serving not just meals, but experiences that remains in your memory.
        </p>

        <p>As you step into The Outer Clove, prepare to taste the heart and soul we put into every dish. Our team is
            dedicated to creating an atmosphere where you feel at home, surrounded by friendly faces and the aroma of
            delicious flavors.</p>

        <p>Our journey began in 2002, and we've been proudly serving communities ever since. From the start, we aimed to
            provide more than just a meal. we wanted to be a part of your memories.</p>

        <p>Originally a small restaurant, we've grown over the years, becoming a beloved spot for locals and visitors
            alike. Our commitment to quality and passion for great food has made The Outer Clove a go-to place for those
            seeking a delightful dining experience.</p>

        <p>Join us at The Outer Clove, where the simplicity of good food meets the warmth of hospitality. We look
            forward to creating memorable moments with you.</p>

        <p>The Outer Clove Team ~</p>

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

    <!-- -------------- Footer -------------- -->

    <?php
    include 'components/footer.php';
    ?>

</body>

</html>