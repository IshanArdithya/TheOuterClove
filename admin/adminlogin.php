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

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
      <link rel="stylesheet" href="../css/admindashboard.css">

      <title>Staff Login</title>
   </head>
   <body>
      <div class="login">
         <img src="assets/img/login-bg.png" alt="image" class="login__bg">

         <form method="post" class="login__form">
            <h1 class="login__title">Login</h1>

            <div class="login__inputs">
               <div class="login__box">
                  <input type="email" name="email" placeholder="Email ID" required class="login__input">
                  <i class="ri-mail-fill"></i>
               </div>

               <div class="login__box">
                  <input type="password" name="password" placeholder="Password" required class="login__input">
                  <i class="ri-lock-2-fill"></i>
               </div>
            </div>

            <div class="login__check">
               <div class="login__check-box">
                  <input type="checkbox" class="login__check-input" id="user-check">
                  <label for="user-check" class="login__check-label">Remember me</label>
               </div>

               <a href="#" class="login__forgot">Forgot Password?</a>
            </div>

            <button type="submit" name="login" class="login__button">Login</button>

            <div class="login__register">
               Don't have an account? <a href="#">Register</a>
            </div>
         </form>
      </div>
   </body>
</html>