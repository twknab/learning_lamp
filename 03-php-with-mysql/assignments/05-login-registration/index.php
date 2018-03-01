<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHP User Login and Registration</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <h1 class="center uber-header">Login & Registration with Trusty Ole' PHP 👨‍🌾</h1>
  <!-- ================= -->
  <!-- REGISTRATION FORM -->
  <!-- ================= -->
  <h1>👤 Register (or <a href="#login" class="sign-in">login</a>)</h1>
  <form action="process.php" method="POST" class="reg-form">
  <!-- If any errors  -->
    <?php 
      if (isset($_SESSION["reg_errors"]) && $_SESSION["reg_errors"]) {
        foreach ($_SESSION["reg_errors"] as $err_type => $errors_array) {
          ?>
          <div class='error'>
            <ul>
              <!-- Loop through each errors array -->
              <?php
                foreach ($errors_array as $error_message) {
                  ?>
                    <li><?= $error_message ?></li>
                  <?php
                }
              ?>
            </ul>
          </div>
        <?php
        }
        unset($_SESSION["reg_errors"]); // resets reg_errors after loading them (so refreshing the page doesn't show errors from session again)
      }
    ?>
    <input type="hidden" name="form_type" value="registration">
    <label for="reg-username">Username:</label>
    <input type="text" id="reg-username" name="username" value="<?php  if (isset($_SESSION["registration"])) { echo $_SESSION["registration"]["username"]; } ?>">
    <label for="reg-firstname">First Name:</label>
    <input type="text" id="reg-firstname" name="first_name" value="<?php  if (isset($_SESSION["registration"])) { echo $_SESSION["registration"]["first_name"]; } ?>">
    <label for="reg-lastname">Last Name:</label>
    <input type="text" id="reg-lastname" name="last_name" value="<?php  if (isset($_SESSION["registration"])) { echo $_SESSION["registration"]["last_name"]; } ?>">
    <label for="reg-email">Email:</label>
    <input type="email" id="reg-email" name="email" value="<?php  if (isset($_SESSION["registration"])) { echo $_SESSION["registration"]["email"]; } ?>">
    <label for="reg-password">Password:</label>
    <input type="password" id="reg-password" name="password">
    <label for="reg-password-confirm">Password Confirmation:</label>
    <input type="password" id="reg-password-confirm" name="password_confirm">
    <input type="submit" value="👍  Register!">
  </form> 
  <!-- ========== -->
  <!-- LOGIN FORM -->
  <!-- ========== -->
  <h1 class="already-reg">already registered? 🙋‍♀️ sign in below!</h1>
  <h1>🔐 Login</h1>
  <form action="process.php" method="POST" class="login-form" id="login">
  <!-- If any errors  -->
    <?php 
      if (isset($_SESSION["login_errors"]) && $_SESSION["login_errors"]) {
        foreach ($_SESSION["login_errors"] as $err_type => $errors_array) {
          ?>
          <div class='error'>
            <ul>
              <!-- Loop through each errors array -->
              <?php
                foreach ($errors_array as $error_message) {
                  ?>
                    <li><?= $error_message ?></li>
                  <?php
                }
              ?>
            </ul>
          </div>
        <?php
        }
        unset($_SESSION["login_errors"]); // resets reg_errors after loading them (so refreshing the page doesn't show errors from session again)
      }
    ?>
    <input type="hidden" name="form_type" value="login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="login-username">
    <label for="password">Password:</label>
    <input type="password" id="password" name="login-password">
    <input type="submit" value="🔑 Login!">
  </form>
</body>
</html>