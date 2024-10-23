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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <h1 class="page-title">Contact Us</h1>
                <ul class="page-title-breadcrumb">
                    <li>
                        <a class="breadcrumb-entry fa-solid fa-house" style="color: #fff;"></a>
                        <a href="http://localhost/TheOuterClove/index.php" class="breadcrumb-entry">Home</a>
                        <a class="breadcrumb-entry">/</a>
                        <a href="http://localhost/TheOuterClove/contact.php" class="breadcrumb-entry">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="page-title-icon">
                <img src="https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/themes/cafenod/assets/images/coffe-icon.png"
                    alt="Menu">
            </div>
        </div>
    </div>

    <!-- -------------- Contact Info -------------- -->

    <div class="main-color2">
        <section id="contact-section">
            <div class="contact-container">
                <div class="contact-form-container">
                    <h2>CONNECT WITH US</h2>
                    <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                        <div class="cform-field">
                            <input type="text" id="cname" name="cname" placeholder="Name" maxlength="100" required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <input type="email" id="cemail" name="cemail" placeholder="Email" maxlength="350" required
                                <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <input type="tel" id="cphone" name="cphone" placeholder="Phone Number" maxlength="12"
                                required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <input type="text" id="csubject" name="csubject" placeholder="Subject" maxlength="100"
                                required <?php echo $readonly; ?>>
                        </div>
                        <div class="cform-field">
                            <textarea id="cmessage" name="cmessage" placeholder="Your Message" minlength="20"
                                maxlength="1000" required <?php echo $readonly; ?>></textarea>
                        </div>
                        <button type="submit" class="cform-button" <?php echo $buttonDisabled; ?>><span></span>
                            <?php echo $buttonText; ?></button>

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
        </section>
    </div>

    <?php
    include 'components/footer.php';
    ?>
</body>

</html>