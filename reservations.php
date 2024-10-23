<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connectdb.php';

    $name = $_POST['rname'];
    $email = $_POST['remail'];
    $phone = $_POST['rphone'];
    $people = $_POST['rpeople'];
    $preferences = $_POST['rpreferences'];
    $date = $_POST['rdate'];
    $time = $_POST['rtime'];
    $description = $_POST['rdescription'];

    $approval = "Pending";

    $sql = "INSERT INTO reservations (name, email, phone, people, preferences, date, time, description, approval) 
                VALUES ('$name', '$email', '$phone', '$people', '$preferences', '$date', '$time', '$description', '$approval')";

    if ($conn->query($sql) === TRUE) {
        $buttonText = "Table Reserved";
        $buttonDisabled = "disabled";
        $readonly = "readonly";
        $selectDisabled = "disabled";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    $buttonText = "Reserve Table";
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

    <!-- -------------- Background images & texts -------------- -->

    <div id="pagetitle" class="pagetitle layout1"
        style="background-image: url(https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/uploads/2021/03/bg-page-title.jpg);">
        <div class="page-title-container">
            <div class="page-title-inner">
                <h1 class="page-title">Reservation</h1>
                <ul class="page-title-breadcrumb">
                    <li>
                        <a class="breadcrumb-entry fa-solid fa-house" style="color: #fff;"></a>
                        <a href="http://localhost/TheOuterClove/index.php" class="breadcrumb-entry">Home</a>
                        <a class="breadcrumb-entry">/</a>
                        <a href="http://localhost/TheOuterClove/reservations.php" class="breadcrumb-entry">Reservation</a>
                    </li>
                </ul>
            </div>
            <div class="page-title-icon">
                <img src="https://demo.cmssuperheroes.com/themeforest/cafenod/wp-content/themes/cafenod/assets/images/coffe-icon.png"
                    alt="Menu">
            </div>
        </div>
    </div>

    <!-- -------------- Reservation Form -------------- -->

    <div class="main-color1">
        <div class="reservation-form-container">
            <h2>BOOK A TABLE</h2>
            <form class="reservation-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                <div class="rform-row">
                    <div class="rform-field">
                        <input type="text" id="rname" name="rname" placeholder="Your Name" maxlength="100" required
                            <?php echo $readonly; ?>>
                    </div>
                    <div class="rform-field">
                        <input type="email" id="remail" name="remail" placeholder="Your Email" maxlength="350" required
                            <?php echo $readonly; ?>>
                    </div>
                </div>

                <div class="rform-row">
                    <div class="rform-field">
                        <input type="tel" id="rphone" name="rphone" placeholder="Your Phone" maxlength="12" required
                            <?php echo $readonly; ?>>
                    </div>
                    <div class="rform-field">
                        <select id="rpeople" name="rpeople" required <?php echo $selectDisabled; ?>>
                            <option value="" disabled selected>No. Of Persons</option>
                            <option value="1">1 Person</option>
                            <option value="2">2 Persons</option>
                            <option value="3">3 Persons</option>
                            <option value="4">4 Persons</option>
                            <option value="4+">4+ Persons</option>
                        </select>
                    </div>
                </div>

                <div class="rform-row">
                    <div class="rform-field">
                        <select id="rpreferences" name="rpreferences" required <?php echo $selectDisabled; ?>>
                            <option value="" disabled selected>Dietary Preferences</option>
                            <option value="None">None</option>
                            <option value="Vegetarian">Vegetarian</option>
                            <option value="Vegan">Vegan</option>
                        </select>
                    </div>
                    <div class="rform-field">
                        <input type="date" id="rdate" name="rdate" placeholder="Date" required <?php echo $readonly; ?>>
                        <span></span>
                        <input type="time" id="rtime" name="rtime" placeholder="Time" required <?php echo $readonly; ?>>
                    </div>
                </div>

                <div class="rform-row">
                    <textarea id="rdescription" name="rdescription" placeholder="Description" maxlength="1000" <?php echo $readonly; ?>></textarea>
                </div>

                <button type="submit" class="rform-button" <?php echo $buttonDisabled; ?>><span></span>
                    <?php echo $buttonText; ?></button>

                <div class="reservation-description">
                    <p>* Kindly book your table at least 24 hours before your desired reservation time.</p>
                    <p>* Your reservation will be either accepted or denied by us. You can check it by logging in to
                        your account.</p>
                    <p>* You'll be contacted by our staff, If the reservation is accepted.</p>
                </div>
            </form>
        </div>
    </div>

    <!-- -------------- Footer -------------- -->

    <?php
    include 'components/footer.php';
    ?>
</body>

</html>