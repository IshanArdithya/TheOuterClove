<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="dashboard_style.css">
    
</head>
<body>

<!-- -------------- Navigation Bar -------------- -->

    <header id="header" class="header">
        <a class="navbar-logo" href="index.php">The Outer <span class="theme-accent-color">Clove</span></a>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="index.php#gallery">Gallery</a>
            <a href="reservations.php">Reservation</a>
            <a href="about.html">About</a>
            <a href="contact.php">Contact Us</a>
        </nav>

        <div class="icons">
            <div class="icons hideit">
                <a href="p1.html" class="material-symbols-outlined">search</a>
            </div>
          
            <div class="icons hideit">
                <a href="p2.html" class="material-symbols-outlined">shopping_cart</a>
            </div>
          
            <div class="icons" id="account-icon">
                <a href="login.php" class="material-symbols-outlined active">account_circle</a>
            </div>
        </div>
    </header>
    
    <!-- -------------- Background Image & Texts -------------- -->

    <div class="m-bg-container">
        <div class="low-dark"></div>
        <div class="m-bg-outer">
            <div class="m-menu-text">
                <h1>Staff</h1>
                <div class="breadcrumb">
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="contact.php">Staff &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <div class="main-color1">
        <div class="reservation-panel-container">
                <h1>ALL RESERVATIONS</h1>
                <?php
                    include 'connectdb.php';

                    $sql = "SELECT * FROM reservations";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        echo '<div class="show-all-reservations-container">';
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="reservation-details">';
                            echo '<p>Name: ' . $row['name'] . '</p>';
                            echo '<p>Email: ' . $row['email'] . '</p>';
                            echo '<p>Phone: ' . $row['phone'] . '</p>';
                            echo '<p>No. of People: ' . $row['people'] . '</p>';
                            echo '<p>Date & Time: ' . $row['date'] . ' ' . $row['time'] . '</p>';
                            echo '<p>Description: ' . $row['description'] . '</p>';
                            echo '<p>Approval: ' . $row['approval'] . '</p>';
                            echo '</div>';
                            echo '<div class="p-r-separate"></div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<p>No reservations found</p>';
                    }

                    $conn->close();
                ?>
        </div>
    </div>
    <div class="main-color2">
        <div class="panel-contact-feedback-container">
            <h1>ALL CONTACTED INFORMATION</h1>
            <?php
                include 'connectdb.php';

                $sql = "SELECT * FROM contact";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="show-all-reservations-container">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="panel-contact-details">';
                        echo '<p>Name: ' . $row['name'] . '</p>';
                        echo '<p>Email: ' . $row['email'] . '</p>';
                        echo '<p>Phone: ' . $row['phone'] . '</p>';
                        echo '<p>Subject: ' . $row['subject'] . '</p>';
                        echo '<p>Message: ' . $row['message'] . '</p>';
                        echo '</div>';
                        echo '<div class="p-r-separate"></div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No contact details found</p>';
                }

                $conn->close();
            ?>
        </div>
    </div>
    <div class="main-color1">
        <div class="panel-contact-feedback-container">
            <h1>FEEDBACKS</h1>
            <?php
                include 'connectdb.php';

                $sql = "SELECT * FROM feedback";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="show-all-feedbacks-container">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="feedback-details">';
                        echo '<p>Name: ' . $row['name'] . '</p>';
                        echo '<p>Overall Experience: ' . $row['overallexperience'] . '</p>';
                        echo '<p>Food Quality: ' . $row['foodquality'] . '</p>';
                        echo '<p>Service: ' . $row['service'] . '</p>';
                        echo '<p>Message: ' . $row['message'] . '</p>';
                        echo '</div>';
                        echo '<div class="p-r-separate"></div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p>No feedback details found</p>';
                }

                $conn->close();
            ?>
        </div>
    </div>

    <!-- -------------- Footer -------------- -->

    <footer id="site-footer">
        <footer id="site-footer">
            <div class="footer-row">
                <div class="footer-column">
                    <h4>About Us</h4>
                    <p>The Outer Clove restaurant, serving delicious meals since 2002, has become a favorite across many cities in Sri Lanka. Our journey began with a passion for great food and a commitment to creating a welcoming dining experience for everyone.</p>
                </div>
        
                <div class="footer-column">
                    <h4>Opening Hours</h4>
                    <p>Monday - Friday</p>
                    <p>8 AM - 10 PM</p>
                    <p>Saturday - Sunday</p>
                    <p>9 AM - 8 PM</p>
                </div>
        
                <div class="footer-column">
                    <h4>Contact Us</h4>
                    <p>
                        Address: 123 Colombo, Sri Lanka<br>
                        Telephone: 011-456-7890<br>
                        Email: info@outerclover.com
                    </p>
                </div>
        
                <div class="footer-column">
                    <h4>Links</h4>
                    <ul class="footer-links">
                    <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="#gallery">Gallery</a></li>
                        <li><a href="reservations.php">Reservation</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        
        <div class="footer-bottom">
            <p>Copyrights &copy; 2023 - <a href="https://github.com/IshanArdithya"><span class="theme-accent-color">Ishan Ardithya</span></a>, All Rights Reserved.</p>
        </div>

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
    </footer>
</body>
</html>