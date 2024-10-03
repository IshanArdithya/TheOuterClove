<?php
include 'connectdb.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
        $checkEmailResult = $conn->query($checkEmailQuery);

        if ($checkEmailResult->num_rows > 0) {
            $errorregister = "Email already exists. Please choose a different email.";
        } else {
            $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$password')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } elseif (isset($_POST['login'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            $_SESSION['user_email'] = $email;

            if ($email == 'admin@outerclove.com') {
                header("Location: admin/reservations.php");
            } else if ($email == 'staff@outerclove.com') {
                header("Location: staffdashboard.php");
            } else {
                header("Location: userdashboard.php");
            }
        } else {
            $errorregister = "Email already exists. Please choose a different email.";
            $errorlogin = "Wrong email or password";
        }
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

    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-wvw1PZt5STwCrZ6xGq+GSE1a5/Sp5j+oN8t02kGGtWQdIzApkzt+ub7svD3Wt5z1hJS/VRuKhKoAO1t32k8sKw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="css/styles.css">
    
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

        <div class="form-box" id="signup-box">
            <h1>Sign Up</h1>
            <form method="post">
                <div class="input-field">
                    <i class="material-symbols-outlined">person</i>
                    <input type="text" name="firstName" placeholder="First Name" required>
                </div>
                <div class="input-field">
                    <i class="material-symbols-outlined">person</i>
                    <input type="text" name="lastName" placeholder="Last Name" required>
                </div>
                <div class="input-field">
                    <i class="material-symbols-outlined">mail</i>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-field">
                    <i class="material-symbols-outlined">lock</i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <!-- using this to show email exists error messagee -->
                <?php
                if (isset($errorregister)) {
                    echo '<p class="loginerror">' . $errorregister . '</p>';
                }
                ?>

                <button type="submit" name="register">Sign Up</button>
            </form>
            <p class="l-option">Already have an account? <a href="#" id="signin-btn">Sign In</a></p>
        </div>
    </div>

    <script>

  document.getElementById('signup-btn').addEventListener('click', function () {
    document.getElementById('login-box').style.display = 'none';
    document.getElementById('signup-box').style.display = 'block';
  });

  document.getElementById('signin-btn').addEventListener('click', function () {
    document.getElementById('login-box').style.display = 'block';
    document.getElementById('signup-box').style.display = 'none';
  });


</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('signup-form').addEventListener('submit', function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            fetch('register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                document.getElementById('signup-response').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

</body>
</html>