<?php
include '../connectdb.php';

session_start();

if (isset($_SESSION['staff'])) {
   if (
      isset($_SESSION['staff']['id']) &&
      isset($_SESSION['staff']['email']) &&
      isset($_SESSION['staff']['role'])
   ) {
      header("Location: reservations.php");
      exit();
   } else {
      unset($_SESSION['staff']);
   }
}

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
   <script src="https://unpkg.com/@popperjs/core@2"></script>
   <script src="https://unpkg.com/tippy.js@6.3.1/dist/tippy-bundle.umd.min.js"></script>

   <title>Staff Login</title>
</head>

<body>
   <div class="login">
      <img src="../images/assets/white-abstract.jpg" alt="image" class="login__bg">

      <form method="post" class="login__form">
         <a href="../index.php" class="exit-button">X</a>
         <h1 class="login__title">
            <span id="typing-effect"></span>
            <span class="cursor">|</span>
         </h1>

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

         <button type="submit" name="login" class="login__button">Login <i
               class="ri-arrow-right-double-fill animate-icon"></i></button>

         <div class="login__register login-flex">
            Email & Password are provided here for testing
            <span class="login-info" data-tippy-content="">
               <svg xmlns="http://www.w3.org/2000/svg" height="15px" viewBox="0 0 24 24" width="15px"
                  fill="currentColor">
                  <path
                     d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 9.5C12.8284 9.5 13.5 8.82843 13.5 8C13.5 7.17157 12.8284 6.5 12 6.5C11.1716 6.5 10.5 7.17157 10.5 8C10.5 8.82843 11.1716 9.5 12 9.5ZM14 15H13V10.5H10V12.5H11V15H10V17H14V15Z">
                  </path>
               </svg>
            </span>
         </div>

      </form>
   </div>

   <script>
      tippy('.login-info', {
         content: `
                  <div>
                     <strong>Login Info</strong><br>
                     admin@outerclove.com<br>
                     12345678
                  </div>
                  `,
         allowHTML: true,
         interactive: true,
         theme: 'light',
      });
   </script>

   <script src="js/adminlogin-title.js"></script>
</body>

</html>