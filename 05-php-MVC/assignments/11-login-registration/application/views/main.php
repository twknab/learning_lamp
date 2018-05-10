<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LAMP Login and Registration</title>
  <style>
    body {
     font-family: arial, courier; 
    }
    input {
      display: block;
      margin: 0 0 10px 0;
      padding: 5px;
    }
    .err {
      color: orange;
      font-weight: bolder;
    }
    /* tr {
      text-align: center;
    }
    table {
      padding: 10px;
      background-color: aliceblue;
    }
    tr form {
      display: inline;
    } */
  </style>
</head>
<body>
  <fieldset>
    <legend><h1>Login</h1></legend>
    <?php
      if (isset($errors_login)) {
    ?>
      <div class="err"><?=$errors_login?></div>
    <?php
      }
    ?>
    <?php echo form_open('user/login') ?>
    <input type="email" name="email" id="email" placeholder="Email Address">
    <input type="password" name="password" id="password" placeholder="Password">
    <input type="submit" value="Login">
  </form>
  </fieldset>
  <fieldset>
    <legend><h1>Register</h1></legend>
      <?php
        if (isset($errors_registration)) {
      ?>
      <div class="err"><?=$errors_registration?></div>
      <?php
        }
      ?>
      <?php echo form_open('user/register') ?>
      <input type="text" name="first_name" id="first_name" placeholder="First Name">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name">
      <input type="email" name="email" id="email" placeholder="Email Address">
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
      <input type="submit" value="Register">
    </form>
  </fieldset>
</body>
</html>