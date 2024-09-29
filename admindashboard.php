<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addproduct_submit'])) {

    $productTitle = $_POST['product_title'];
    $productDescription = $_POST['product_description'];
    $productPrice = $_POST['product_price'];

    $targetDir = "images/products/";
    $targetFile = $targetDir . basename($_FILES["product_image"]["name"]);
    move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile);

    $sql = "INSERT INTO products (product_title, product_description, product_price, image_path)
            VALUES ('$productTitle', '$productDescription', '$productPrice', '$targetFile')";

    if ($conn->query($sql) === TRUE) {
        echo "Product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['deleteproduct_submit'])) {
    $deleteProductName = $_POST['delete_product_name'];

    $sql = "DELETE FROM products WHERE product_title = ?";
    $delete = $conn->prepare($sql);
    $delete->bind_param("s", $deleteProductName);
    $delete->execute();

    if ($delete->affected_rows > 0) {
        echo "Product deleted successfully!";
    } else {
        echo "Product not found.";
    }

    $delete->close();
}


$conn->close();
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
                <h1>Admin</h1>
                <div class="breadcrumb">
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="contact.php">Admin &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Admin -------------- -->

    <div class="main-color1">
        <div class="addproducts-form-container">
            <h2>Add Product</h2>
            <form id="addproducts-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                <label for="addproduct_title">Product Name:</label>
                <input type="text" id="addproduct_title" name="product_title" minlength="3" maxlength="35" required>

                <label for="addproduct_description">Product Description:</label>
                <textarea id="addproduct_description" name="product_description" minlength="5" maxlength="75" required></textarea>

                <label for="addproduct_price">Product Price:</label>
                <input type="number" id="addproduct_price" name="product_price" step="0.01" required>

                <label for="addproduct_image">Product Image:</label>
                <input type="file" id="addproduct_image" name="product_image" accept="image/*" required>

                <button type="submit" name="addproduct_submit">Add Product</button>
            </form>
        </div>

        <div class="deleteproduct-form-container">
            <h2>Delete Product</h2>
            <form id="deleteproduct-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="deleteproduct-name">Product Name:</label>
                <input type="text" id="deleteproduct-name" name="delete_product_name" required>

                <button type="submit" name="deleteproduct_submit">Delete Product</button>
            </form>
        </div>
    </div>

    <div class="main-color2">
        <div class="reservation-admin-container">
            <h1>RESERVATION APPROVAL</h1>
            <form id="pending-reservations-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                

                <?php
                    include 'connectdb.php';

                    $sql = "SELECT * FROM reservations WHERE approval = 'Pending'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<p>Name: ' . $row['name'] . '</p>';
                            echo '</div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<p>Email: ' . $row['email'] . '</p>';
                            echo '</div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<p>Phone: ' . $row['phone'] . '</p>';
                            echo '</div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<p>No. of People: ' . $row['people'] . '</p>';
                            echo '</div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<p>Date & Time: ' . $row['date'] . ' ' . $row['time'] . '</p>';
                            echo '</div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<p>Description: ' . $row['description'] . '</p>';
                            echo '</div>';
                            echo '<div class = "p-r-form-group">';
                            echo '<label for="approval_' . $row['id'] . '">Approval:</label>';
                            echo '<select name="approval_' . $row['id'] . '">';
                            echo '<option value="Pending">Pending</option>';
                            echo '<option value="Approved">Approved</option>';
                            echo '<option value="Declined">Declined</option>';
                            echo '</select>';
                            echo '</div>';
                            echo '<div class="p-r-separate"></div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class = "p-r-form-group">';
                        echo '<p>No pending reservations</p>';
                        echo '</div>';
                    }


                    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['approvalconfirm_button'])) {

                        foreach ($_POST as $key => $value) {
                            if (strpos($key, 'approval_') === 0) {
                                $reservationId = substr($key, strlen('approval_'));
                                $approvalStatus = $value;

                                $sql = "UPDATE reservations SET approval = '$approvalStatus' WHERE id = '$reservationId'";
                                $conn->query($sql);
                            }
                        }
                        echo '<meta http-equiv="refresh" content="0">'; // using this because when I confirm product approve or decline, its not updating. so using this to refresh page..
                    }
                    $conn->close();
                ?>

                <button type="submit" name="approvalconfirm_button">Confirm</button>
            </form>
        </div>
        
        <div class="reservation-admin-container">
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

    <div class="main-color1">
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

    <div class="main-color2">
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