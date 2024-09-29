<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        include 'connectdb.php';

        $name = $_POST['cname'];
        $email = $_POST['cemail'];
        $phone = $_POST['cphone'];
        $subject = $_POST['csubject'];
        $message = $_POST['cmessage'];
        $status = 'Pending';

        $sql = "INSERT INTO contact (name, email, phone, subject, message, status)
                VALUES ('$name', '$email', '$phone', '$subject', '$message', '$status')";

        if ($conn->query($sql) === TRUE) {
            $buttonText = "Thanks for Contacting us!";
            $buttonDisabled = "disabled";
            $readonly = "readonly";
            $selectDisabled = "disabled";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        $buttonText = "Submit";
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<!-- -------------- Navigation Bar -------------- -->

<?php
        include 'components/header.php'
    ?>

    <!-- -------------- Background Image & Texts -------------- -->

    <div class="m-bg-container">
        <div class="low-dark"></div>
        <div class="m-bg-outer">
            <div class="m-menu-text">
                <h1>Contact Us</h1>
                <div class="breadcrumb">
                    <a href="index.php">Home &gt;</a> &nbsp;&nbsp; <a href="contact.php">Contact Us &gt;</a>
                </div>
            </div>
        </div>
    </div>

    <!-- -------------- Contact Info -------------- -->

    <div class="main-color2">
        <div class="contact-container">
            <div class="contact-form-container">
                <h2>CONNECT WITH US</h2>
                <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    
                        <div class="cform-field">
                            <input type="text" id="cname" name="cname" placeholder="Name" maxlength="100" required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <input type="email" id="cemail" name="cemail" placeholder="Email" maxlength="350" required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <input type="tel" id="cphone" name="cphone" placeholder="Phone Number" maxlength="12" required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <input type="text" id="csubject" name="csubject" placeholder="Subject" maxlength="100" required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <textarea id="cmessage" name="cmessage" placeholder="Your Message" minlength="20" maxlength="1000" required <?php echo $readonly; ?>></textarea>
                        </div>
                        <button type="submit" class="cform-button" <?php echo $buttonDisabled; ?>><span></span> <?php echo $buttonText; ?></button>
                    
                </form>
            </div>
            <div class="contact-info-container">
                <div class="contact-info">
                    <div class="icon-title-container">
                        <img class="c-info-icon1" src="images/icons/address-book-solid.png">
                        <h3>Contact Info</h3>
                    </div>
                    <div class="c-info-text">
                        <p>Address:</p>
                        <p>123, Colombo, Sri Lanka</p>
                        <p>Telephone:</p>
                        <p>011 456 7890</p>
                        <p>Email:</p>
                        <p>support@outerclover.com</p>
                    </div>
                </div>
                <div class="opening-hours">
                    <div class="icon-title-container">
                        <img class="c-info-icon2" src="images/icons/clock-regular.png">
                        <h3>Opening Hours</h3>
                    </div>
                    <div class="c-info-text">
                        <p>Monday - Friday</p>
                        <p>8 AM - 10 PM</p>
                        <p>Saturday - Sunday</p>
                        <p>9 AM - 8 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        include 'components/footer.php';
    ?>
</body>
</html>