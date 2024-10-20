<?php
include '../connectdb.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM staff_users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['status'] === 'active') {
            if (password_verify($password, $user['password'])) {
                $_SESSION['staff'] = [
                    'id' => $user['staff_user_id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                header("Location: reservations.php");
                exit();
            } else {
                echo "Invalid email or password.";
            }
        } else {
            if ($user['status'] === 'suspended') {
                echo "Your account is suspended. Please contact support.";
            } else {
                echo "Your account is inactive. Please contact support.";
            }
        }
    } else {
        echo "Invalid email or password.";
    }
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Outer Clover Restaurant</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="../css/styles.css">

</head>

<body>

    <!-- -------------- Navigation Bar -------------- -->

    <header class="header">
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

            <div class="icons">
                <a href="p2.html" class="material-symbols-outlined">shopping_cart</a>
            </div>

            <div class="icons" id="account-icon">
                <a class="material-symbols-outlined active">account_circle</a>
            </div>
        </div>
    </header>

    <div class="login-container">
        <div class="form-box" id="login-box">
            <h1>Sign In</h1>
            <form method="post">
                <div class="input-field">
                    <i class="material-symbols-outlined">mail</i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-field">
                    <i class="material-symbols-outlined">lock</i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <p><a href="#">Forgot password?</a></p>

                <!-- using this to show wrong email/pw error message -->
                <?php
                if (isset($errorlogin)) {
                    echo '<p class="loginerror">' . $errorlogin . '</p>';
                }
                ?>

                <button type="submit" name="login">Sign In</button>
            </form>

            <p class="l-option">Don't have an account? <a href="#" id="signup-btn">Sign Up</a></p>
        </div>

    </div>

</body>

</html>