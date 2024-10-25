<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connectdb.php';

    $name = $_POST['f_name'];
    $overallexperience = $_POST['f_overall_experience'];
    $fquality = $_POST['f_quality'];
    $service = $_POST['f_service'];
    $description = $_POST['f_description'];

    $stmt = $conn->prepare("INSERT INTO feedback (name, overallexperience, foodquality, service, message) VALUES (?, ?, ?, ?, ?)");

    $stmt->bind_param("sssss", $name, $overallexperience, $fquality, $service, $description);

    if ($stmt->execute()) {
        $buttonText = "Thanks for the feedback!";
        $buttonDisabled = "disabled";
        $readonly = "readonly";
        $selectDisabled = "disabled";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $buttonText = "Send Feedback";
    $buttonDisabled = "";
    $readonly = "";
    $selectDisabled = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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

    <!-- -------------- Background Image & Buttons -------------- -->

    <div class="slider-container">
        <div class="slider">
            <div class="low-dark"></div>
            <div class="slider-logobtn">
                <img src="images/outer-clover.png" alt="Logo" class="brandlogo">
                <div class="slider-btn">
                    <a href="#welcome" class="boxed-btn">Get Started</a>
                    <a href="menu.php" class="bordered-btn">Menu</a>
                </div>
            </div>
            <div class="list">
                <div class="item"><img src="images/gallery/g1.jpg" alt=""></div>
                <div class="item"><img src="images/gallery/g2.jpg" alt=""></div>
                <div class="item"><img src="images/gallery/g3.jpg" alt=""></div>
                <div class="item"><img src="images/gallery/g5.jpg" alt=""></div>
                <div class="item"><img src="images/gallery/g10.jpg" alt=""></div>
            </div>
            <div class="buttons">
                <button id="prev"><</button>
                <button id="next">></button>
            </div>
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>

    <!-- -------------- Welcome -------------- -->
     
    <div id="first-section">
        <div id="welcome" class="main-color1 scroll">
            <div class="main-container">
                <div class="heading-wrap">
                    <h2 class="block-title">Welcome</h2>
                    <p>Welcome to The Outer Clove, your ultimate dining destination in Sri Lanka. As the town's top
                        restaurant,
                        we're thrilled to bring you daily offers that elevate your dining experience.</p>
                    <p>Whether it's a delightful breakfast, a weekend treat, or a quick bite, we've got something special
                        for
                        every occasion. Join us to turn each visit into a celebration of great food and good times.</p>
                    <p>Your satisfaction is our priority, making every moment at The Outer Clove memorable!</p>
                </div>
            </div>
        </div>
    </div>


    <!-- -------------- Offers -------------- -->

    <div id="offers" class="main-color2 scroll">
        <div class="main-container">
            <div class="heading-wrap">
                <h2 class="block-title">Our <span class="theme-accent-color">Offers</span></h2>
                <h3 class="mini-title">We've got some exclusive and exciting offers waiting just for you!</h3>
            </div>

            <?php
            include 'connectdb.php';

            $query = "SELECT product_title, original_price, discount_price, image_path FROM products WHERE has_offer = 1";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                echo '<div class="offer-cards">';

                while ($row = $result->fetch_assoc()) {
                    $productName = htmlspecialchars($row['product_title']);
                    $originalPrice = htmlspecialchars($row['original_price']);
                    $discountPrice = htmlspecialchars($row['discount_price']);
                    $imagePath = htmlspecialchars($row['image_path']);

                    echo '<div class="offer-card">';
                    echo '<img src="' . $imagePath . '" alt="' . $productName . '">';
                    echo '<div class="offer-details">';
                    echo '<h4 class="o-product-name">' . $productName . '</h4>';
                    echo '<p class="o-original-price">Rs.' . number_format($originalPrice, 2) . '</p>';
                    echo '<p class="o-discounted-price">Now Rs.' . number_format($discountPrice, 2) . '</p>';
                    echo '<a href="menu.php" class="details-btn">Details</a>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
            } else {
                echo '<p id="no-offers-message" class="no-offers"><span id="typing-effect"></span><span class="cursor">|</span></p>';
            }

            $conn->close();
            ?>

        </div>
    </div>


    <!-- -------------- Images with Buttons for Menu & Reservation -------------- -->

    <div id="imagesides" class="main-color1 scroll">
        <div class="imagesides-row">
            <div class="imagesides-column">
                <div class="low-dark"></div>
                <img src="images/gallery/g1.jpg">
                <div class="imagesides-content">
                    <h2>DELICIOUS DELIGHTS ON THE <span class="theme-accent-color">MENU</span></h2>
                    <p>
                        Discover a variety of delicious dishes on our online menu! From tasty starters to satisfying
                        main courses and sweet treats, it's all just a click away. Order easily and enjoy The Outer
                        Clove's flavors from the comfort of your home. Treat yourself to a simple and delightful
                        dining
                        experience with our convenient online menu!
                    </p>
                    <a href="menu.php" class="imagesides-btn">MENU</a>
                </div>
            </div>

            <div class="imagesides-column">
                <div class="low-dark"></div>
                <img src="images/gallery/g2.jpg">
                <div class="imagesides-content">
                    <h2>RESERVE YOUR <span class="theme-accent-color">TABLE</span></h2>
                    <p>
                        Experience seamless dining with our reservation service. Skip the wait and guarantee your
                        favorite table with just a few clicks. Whether it's a cozy dinner for two or a celebration
                        with
                        friends, our easy online reservation system ensures your seat is ready when you are. Book
                        now
                        and get ready to enjoy a delightful dining experience at The Outer Clove!
                    </p>
                    <a href="reservations.php" class="imagesides-btn">RESERVATION</a>
                </div>
            </div>
        </div>
    </div>


    <!-- -------------- Gallery -------------- -->

    <div id="gallery" class="main-color2 scroll">
        <div class="main-container">
            <div class="heading-wrap">
                <h2 class="block-title">Gallery of <span class="theme-accent-color">Goodness</span></h2>
                <h3 class="mini-title">Take a look at our yummy dishes!</h3>
            </div>
            <div class="gallery-grid-container">
                <div class="gallery-grid-wrapper">
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g1.jpg" data-src="images/gallery/g1.jpg" class="lazy"
                            alt="Gallery Image 1">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g2.jpg" data-src="images/gallery/g2.jpg" class="lazy"
                            alt="Gallery Image 2">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g3.jpg" data-src="images/gallery/g3.jpg" class="lazy"
                            alt="Gallery Image 3">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g4.jpg" data-src="images/gallery/g4.jpg" class="lazy"
                            alt="Gallery Image 4">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g5.jpg" data-src="images/gallery/g5.jpg" class="lazy"
                            alt="Gallery Image 5">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g6.jpg" data-src="images/gallery/g6.jpg" class="lazy"
                            alt="Gallery Image 6">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g7.jpg" data-src="images/gallery/g7.jpg" class="lazy"
                            alt="Gallery Image 7">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g8.jpg" data-src="images/gallery/g8.jpg" class="lazy"
                            alt="Gallery Image 8">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g9.jpg" data-src="images/gallery/g9.jpg" class="lazy"
                            alt="Gallery Image 9">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g10.jpg" data-src="images/gallery/g10.jpg" class="lazy"
                            alt="Gallery Image 10">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g11.jpg" data-src="images/gallery/g11.jpg" class="lazy"
                            alt="Gallery Image 11">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g12.jpg" data-src="images/gallery/g12.jpg" class="lazy"
                            alt="Gallery Image 12">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g13.jpg" data-src="images/gallery/g13.jpg" class="lazy"
                            alt="Gallery Image 13">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g14.jpg" data-src="images/gallery/g14.jpg" class="lazy"
                            alt="Gallery Image 14">
                    </div>
                    <div class="gallery-grid-img">
                        <img src="images/gallery/g15.jpg" data-src="images/gallery/g15.jpg" class="lazy"
                            alt="Gallery Image 15">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- -------------- Featured Feedbacks -------------- -->

    <div id="featuredfeedbacks" class="main-color1 scroll">
        <div class="main-container">
            <div class="heading-wrap">
                <h2 class="block-title"><span class="theme-accent-color">Featured </span>Feedbacks</h2>
                <h3 class="mini-title">See what others love about us!</h3>
            </div>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <img class="feedback-image" src="images/feedbacks/avatar1.png">
                            <h4 class="feedback-author">Tharindu Hulangamuwa</h4>
                            <p class="feedback-text">"Delicious experience! The Fries were perfectly cooked, and the
                                atmosphere was cozy. Thumbs up!"</p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <img class="feedback-image" src="images/feedbacks/avatar1.png">
                            <h4 class="feedback-author">Janith Rajindra</h4>
                            <p class="feedback-text">"Lovely place! The roti rolls were a hit, and the biryani was full
                                of
                                flavor. Coming back for more for sure!"</p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <img class="feedback-image" src="images/feedbacks/avatar1.png">
                            <h4 class="feedback-author">Roshara Pathirage</h4>
                            <p class="feedback-text">"The chicken curry is a must-try! Flavorful and not too spicy.
                                Plus,
                                the dessert options are heavenly!"</p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <img class="feedback-image" src="images/feedbacks/avatar1.png">
                            <h4 class="feedback-author">Yasanga Ransith</h4>
                            <p class="feedback-text">"Tried the garlic fries and they were amazing! Quick service and
                                affordable prices. Definitely recommending to my friends."</p>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="feedback-card">
                            <img class="feedback-image" src="images/feedbacks/avatar1.png">
                            <h4 class="feedback-author">Hirusha Dheemantha</h4>
                            <p class="feedback-text">"Spectacular! We had an amazing tasting menu. The food was
                                exquisite,
                                great service and atmosphere."</p>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>


    <!-- -------------- Feedback Form -------------- -->

    <div id="userfeedbacks" class="main-color2 scroll">
        <div class="main-container">
            <div class="heading-wrap">
                <h2 class="block-title">Share Your <span class="theme-accent-color">Thoughts</span></h2>
                <h3 class="mini-title">Share what you think about us!</h3>
            </div>

            <div class="feedback-form-container">
                <form id="feedbackform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="fform-row">
                        <div class="fform-field">
                            <input type="text" id="f_name" name="f_name" placeholder="Your Name" maxlength="100"
                                required <?php echo $readonly; ?>>
                        </div>
                        <div class="fform-field">
                            <input type="number" id="f_overall_experience" name="f_overall_experience"
                                placeholder="Overall Experience [1-5]" min="1" max="5" required <?php echo $readonly; ?>>
                        </div>
                    </div>

                    <div class="fform-row">
                        <div class="fform-field">
                            <input type="number" id="f_quality" name="f_quality" placeholder="Food Quality [1-5]"
                                min="1" max="5" required <?php echo $readonly; ?>>
                        </div>
                        <div class="fform-field">
                            <input type="number" id="f_service" name="f_service" placeholder="Service [1-5]" min="1"
                                max="5" required <?php echo $readonly; ?>>
                        </div>
                    </div>

                    <div class="rform-row">
                        <textarea id="f_description" name="f_description" placeholder="Message" maxlength="1000" <?php echo $readonly; ?>></textarea>
                    </div>

                    <button type="submit" class="fform-button" <?php echo $buttonDisabled; ?>><?php echo $buttonText; ?></button>
                </form>
            </div>
        </div>
    </div>

    <!-- -------------- Footer -------------- -->

    <?php
    include 'components/footer.php';
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const homeButton = document.getElementById("homebutton");
            const galleryButton = document.getElementById("gallerybutton");

            const gallerySection = document.getElementById("gallery");

            homeButton.classList.add("active");

            gallerySection.addEventListener("mouseover", function () {
                homeButton.classList.remove("active");
                galleryButton.classList.add("active");
            });

            gallerySection.addEventListener("mouseout", function () {
                homeButton.classList.add("active");
                galleryButton.classList.remove("active");
            });

        });
    </script>

    <script>
        var swiper = new Swiper('.swiper-container', {
            centeredSlides: true,
            loop: true,
            allowTouchMove: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            autoplay: {
                delay: 5000,
            },

        });
    </script>

    <script src="js/index-page/no-offers.js"></script>
    <script src="js/index-page/fade-in.js"></script>
    <script src="js/index-page/gallery-load.js"></script>
    <script src="js/index-page/bg-image.js"></script>
    <script src="js/header.js"></script>
    <script src="js/scroll-to-top.js"></script>

</body>

</html>