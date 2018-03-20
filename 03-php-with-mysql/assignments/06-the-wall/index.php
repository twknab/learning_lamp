<?php 
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles.css">
  <title>The Wall</title>
</head>
<body>
  <p>Login or register below:</p>
  <h1>Login</h1>
  <form action="/process.php" method="POST">
  <?php 
  if (isset($_SESSION["login_errors"]) && $_SESSION["login_errors"]) {
    foreach ($_SESSION["login_errors"] as $message) {
   ?>
    <div class="err">
      <p><?=$message?></p>
    </div>
  <?php 
    }
  }
  ?>
  <input type="hidden" name="form_type" value="login">
  Email: <input type="email" name="email" placeholder="user@email.com" id="email">
  Password: <input type="password" name="password" id="password">
  <input type="submit" value="Login!">
  </form>
  
  <h1>Register</h1>
  <form action="/process.php" method="POST">
  <?php 
  if (isset($_SESSION["reg_errors"]) && $_SESSION["reg_errors"]) {
    foreach ($_SESSION["reg_errors"] as $message) {
   ?>
    <div class="err">
      <p><?=$message?></p>
    </div>
  <?php 
    }
  }
  ?>
  <input type="hidden" name="form_type" value="register">
  First Name: <input type="text" name="first_name" id="first_name" placeholder="First Name">
  Last Name: <input type="text" name="last_name" id="last_name" placeholder="Last Name">
  Email: <input type="email" name="email" placeholder="user@email.com" id="email">
  Password: <input type="password" name="password" id="password">
  Password: <input type="password" name="confirm_password" id="confirm_password">
  <input type="submit" value="Register!">
  </form>
</body>
</html>