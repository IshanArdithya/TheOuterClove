<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        include 'connectdb.php';

        $name = $_POST['f_name'];
        $overallexperience = $_POST['f_overall_experience'];
        $fquality = $_POST['f_quality'];
        $service = $_POST['f_service'];
        $description = $_POST['f_description'];

        $sql = "INSERT INTO feedback (name, overallexperience, foodquality, service, message)
                VALUES ('$name', '$overallexperience', '$fquality', '$service', '$description')";

        if ($conn->query($sql) === TRUE) {
            $buttonText = "Thanks for the feedback!";
            $buttonDisabled = "disabled";
            $readonly = "readonly";
            $selectDisabled = "disabled";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        $buttonText = "Send Feedback";
        $buttonDisabled = "enabled";
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

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="style.css">

</head>
<body>

    <!-- -------------- Navigation Bar -------------- -->

    <?php
        include 'components/header.php'
    ?>

    <!-- -------------- Background Image & Buttons -------------- -->

    <div class="bg-container">
        <div class="low-dark"></div>
        <div class="bg-outer">
            <div class="intro-text">
                <div class="intro-heading" data-wow-delay="0.8s"><img src="images/outer-clover.png"></div>
                <div class="intro-btns">
                    <a href="#welcome" class="boxed-btn">Get Started</a>
                    <a href="menu.php" class="bordered-btn">Menu</a>  
                </div>
            </div>
        </div>
    </div>
    

    <!-- -------------- Welcome -------------- -->

    <div id="welcome" class="main-color1">
        <div class="heading-wrap">
            <h2 class="block-title">Welcome</h2>
            <p>Welcome to The Outer Clove, your ultimate dining destination in Sri Lanka. As the town's top restaurant, we're thrilled to bring you daily offers that elevate your dining experience.</p>
            <p>Whether it's a delightful breakfast, a weekend treat, or a quick bite, we've got something special for every occasion. Join us to turn each visit into a celebration of great food and good times.</p>
            <p>Your satisfaction is our priority, making every moment at The Outer Clove memorable!</p>
        </div>
    </div>


    <!-- -------------- Offers -------------- -->

    <div id="offers" class="main-color2">
        <div class="heading-wrap">
            <h2 class="block-title">Our <span class="theme-accent-color">Offers</span></h2>
            <h3 class="mini-title">We've got some exclusive and exciting offers waiting just for you!</h3>
        </div>

        <div class="offer-cards">
            <div class="offer-card">
                <img src="images/offers/p1.jpg" alt="Product 1">
                <div class="offer-details">
                    <h4 class="o-product-name">Hamburger</h4>
                    <p class="o-original-price">Rs.950</p>
                    <p class="o-discounted-price">Now Rs.800</p>
                    <a href="menu.php" class="details-btn">Details</a>
                </div>
            </div>
            <div class="offer-card">
                <img src="images/offers/p2.jpg" alt="Product 2">
                <div class="offer-details">
                    <h4 class="o-product-name">Pizza</h4>
                    <p class="o-original-price">Rs.3500</p>
                    <p class="o-discounted-price">Now Rs.3200</p>
                    <a href="menu.php" class="details-btn">Details</a>
                </div>
            </div>
            <div class="offer-card">
                <img src="images/offers/p3.jpg" alt="Product 3">
                <div class="offer-details">
                    <h4 class="o-product-name">Submarine</h4>
                    <p class="o-original-price">Rs.1800</p>
                    <p class="o-discounted-price">Now Rs.1400</p>
                    <a href="menu.php" class="details-btn">Details</a>
                </div>
            </div>
        </div>
    </div>


    <!-- -------------- Images with Buttons for Menu & Reservation -------------- -->

    <div id="imagesides" class="main-color1">
        <div class="imagesides-row">
            <div class="imagesides-column">
                <div class="low-dark"></div>
                <img src="images/gallery/g1.jpg">
                <div class="imagesides-content">
                    <h2>DELICIOUS DELIGHTS ON THE <span class="theme-accent-color">MENU</span></h2>
                    <p>
                        Discover a variety of delicious dishes on our online menu! From tasty starters to satisfying main courses and sweet treats, it's all just a click away. Order easily and enjoy The Outer Clove's flavors from the comfort of your home. Treat yourself to a simple and delightful dining experience with our convenient online menu!
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
                        Experience seamless dining with our reservation service. Skip the wait and guarantee your favorite table with just a few clicks. Whether it's a cozy dinner for two or a celebration with friends, our easy online reservation system ensures your seat is ready when you are. Book now and get ready to enjoy a delightful dining experience at The Outer Clove!
                    </p>
                    <a href="reservations.php" class="imagesides-btn">RESERVATION</a>
                </div>
            </div>
        </div>
    </div>


    <!-- -------------- Gallery -------------- -->

    <div id="gallery" class="main-color2">
        <div class="heading-wrap">
            <h2 class="block-title">Gallery of <span class="theme-accent-color">Goodness</span></h2>
            <h3 class="mini-title">Take a look at our yummy dishes!</h3>
        </div>
        <div class="gallery-grid-container">
            <div class="gallery-grid-wrapper">
                <div class="gallery-grid-img">
                    <img src="images/gallery/g1.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g2.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g3.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g4.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g5.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g6.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g7.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g8.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g9.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g10.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g11.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g12.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g13.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g14.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g15.jpg">
                </div>
                <div class="gallery-grid-img">
                    <img src="images/gallery/g16.jpg">
                </div>
            </div>
        </div>
    </div>



    <!-- -------------- Featured Feedbacks -------------- -->

    <div id="featuredfeedbacks" class="main-color1">
        <div class="heading-wrap">
            <h2 class="block-title"><span class="theme-accent-color">Featured </span>Feedbacks</h2>
            <h3 class="mini-title">See what others love about us!</h3>
        </div>

        <div class="feedback-cards">
            <input type="radio" name="slide" id="slide1" checked>
            <div class="feedback-card">
                <img class="feedback-image" src="images/feedbacks/avatar1.png">
                <h4 class="feedback-author">Tharindu Hulangamuwa</h4>
                <p class="feedback-text">"Delicious experience! The Fries were perfectly cooked, and the atmosphere was cozy. Thumbs up!"</p>
            </div>
        
            <input type="radio" name="slide" id="slide2">
            <div class="feedback-card">
                <img class="feedback-image" src="images/feedbacks/avatar1.png">
                <h4 class="feedback-author">Janith Rajindra</h4>
                <p class="feedback-text">"Lovely place! The roti rolls were a hit, and the biryani was full of flavor. Coming back for more for sure!"</p>
            </div>
        
            <input type="radio" name="slide" id="slide3">
            <div class="feedback-card">
                <img class="feedback-image" src="images/feedbacks/avatar1.png">
                <h4 class="feedback-author">Roshara Pathirage</h4>
                <p class="feedback-text">"The chicken curry is a must-try! Flavorful and not too spicy. Plus, the dessert options are heavenly!"</p>
            </div>
        
            <input type="radio" name="slide" id="slide4">
            <div class="feedback-card">
                <img class="feedback-image" src="images/feedbacks/avatar1.png">
                <h4 class="feedback-author">Yasanga Ransith</h4>
                <p class="feedback-text">"Tried the garlic fries and they were amazing! Quick service and affordable prices. Definitely recommending to my friends."</p>
            </div>
        
            <input type="radio" name="slide" id="slide5">
            <div class="feedback-card">
                <img class="feedback-image" src="images/feedbacks/avatar1.png">
                <h4 class="feedback-author">Hirusha Dheemantha</h4>
                <p class="feedback-text">"Spectacular! We had an amazing tasting menu. The food was exquisite, great service and atmosphere."</p>
            </div>
            
            <div class="feedback-navigation">
                <label for="slide1"></label>
                <label for="slide2"></label>
                <label for="slide3"></label>
                <label for="slide4"></label>
                <label for="slide5"></label>
            </div>
        </div>
    </div>

    <!-- -------------- Feedback Form -------------- -->

    <div id="userfeedbacks" class="main-color2">
        <div class="heading-wrap">
            <h2 class="block-title">Share Your <span class="theme-accent-color">Thoughts</span></h2>
            <h3 class="mini-title">Share what you think about us!</h3>
        </div>

    <div class="feedback-form-container">
            <form id="feedbackform" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="fform-row">
                    <div class="fform-field">
                        <input type="text" id="f_name" name="f_name" placeholder="Your Name" maxlength="100" required <?php echo $readonly; ?>>
                    </div>
                    <div class="fform-field">
                    <input type="number" id="f_overall_experience" name="f_overall_experience" placeholder="Overall Experience [1-5]" min="1" max="5" required <?php echo $readonly; ?>>
                    </div>
                </div>

                <div class="fform-row">
                    <div class="fform-field">
                    <input type="number" id="f_quality" name="f_quality" placeholder="Food Quality [1-5]" min="1" max="5" required <?php echo $readonly; ?>>
                    </div>
                    <div class="fform-field">
                    <input type="number" id="f_service" name="f_service" placeholder="Service [1-5]" min="1" max="5" required <?php echo $readonly; ?>>
                    </div>
                </div>

                <div class="rform-row">
                    <textarea id="f_description" name="f_description" placeholder="Description" maxlength="1000" <?php echo $readonly; ?>></textarea>
                </div>
                
                <button type="submit" class="fform-button" <?php echo $buttonDisabled; ?>><?php echo $buttonText; ?></button>
            </form>
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

        homeButton.classList.add("active"); // it will make the home button as the active button by default..

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

    <!-- Using this script to make the navigation bar black when scroll down -->
    <script>
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            document.getElementById("header").style.background = "rgba(38, 38, 38, 1)";
            } else {
            document.getElementById("header").style.background = "transparent";
            }
        }
    </script>

</body>
</html>