<?php
session_start();
if (isset($_SESSION["registered"])) { // if user already registered
  header("Location: confirmation.php"); // load confirmation page
  die(); // kill this php page
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PHP Registration Without DB</title>
    <style>
      fieldset { padding: 15px; width: 50%; }
      form { display: block; }
      label, input { display: block; }
      input { margin-bottom: 15px; width: 97%; padding: 5px; }
      input[type="submit"] { padding: 10px; }
      .error { border: 2px solid orange; }
      .error + p { color: orange; font-weight: bold; font-style: italic; }
      .success { border: 2px solid lightgreen; }
    </style>
  </head>
  <body>
    <!-- User Registration -->
    <fieldset>
      <legend>Register!</legend>
      <form class="registration_form" action="process.php" method="post" enctype="multipart/form-data">
        <!-- Email -->
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Email"
          <?php if (isset($_SESSION["status"]["email"])) {
            echo "class='{$_SESSION["status"]["email"]}'";
            if (isset($_SESSION["email"])) {
              echo "value='{$_SESSION["email"]}'";
            };
          };
          ?> required>
          <?php
            if (isset($_SESSION["errors"]["email"])) {
              echo "<p>{$_SESSION['errors']['email']}</p>";
            };
          ?>
        <!-- First Name -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" placeholder="First Name"
          <?php if (isset($_SESSION["status"]["first_name"])) {
            echo "class='{$_SESSION["status"]["first_name"]}'";
            if (isset($_SESSION["first_name"])) {
              echo "value='{$_SESSION["first_name"]}'";
            };
          };
          ?> required>
          <?php
            if (isset($_SESSION["errors"]["first_name"])) {
              echo "<p>{$_SESSION['errors']['first_name']}</p>";
            };;
          ?>
        <!-- Last Name -->
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" placeholder="Last Name"
          <?php if (isset($_SESSION["status"]["last_name"])) {
            echo "class='{$_SESSION["status"]["last_name"]}'";
            if (isset($_SESSION["last_name"])) {
              echo "value='{$_SESSION["last_name"]}'";
            };
          };
          ?> required>
          <?php
            if (isset($_SESSION["errors"]["last_name"])) {
              echo "<p>{$_SESSION['errors']['last_name']}</p>";
            };
          ?>
        <!-- Password -->
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Password"
          <?php if (isset($_SESSION["status"]["password"])) {
            echo "class='{$_SESSION["status"]["password"]}'";
          };
          ?> required>
          <?php
            if (isset($_SESSION["errors"]["password"])) {
              echo "<p>{$_SESSION['errors']['password']}</p>";
            };
          ?>
        <!-- Password Confirmation -->
        <label for="password_confirm">Confirm Password:</label>
        <input type="password" name="password_confirm" placeholder="Confirm Password"
          <?php if (isset($_SESSION["status"]["password_confirm"])) {
            echo "class='{$_SESSION["status"]["password_confirm"]}'";
          };
          ?> required>
          <?php
            if (isset($_SESSION["errors"]["password_confirm"])) {
              echo "<p>{$_SESSION['errors']['password_confirm']}</p>";
            };
          ?>
        <!-- Birth Date -->
        <label for="birth_date">Birth Date:</label>
        <input type="date" name="birth_date" placeholder="Birth Date"
          <?php if (isset($_SESSION["status"]["birth_date"])) {
            echo "class='{$_SESSION["status"]["birth_date"]}'";
            if (isset($_SESSION["birth_date"])) {
              echo "value='{$_SESSION["birth_date"]}'";
            };
          };
          ?> >
          <?php
            if (isset($_SESSION["errors"]["birth_date"])) {
              echo "<p>{$_SESSION['errors']['birth_date']}</p>";
            };
          ?>
        <!-- Profile Photo -->
        <label for="profile_photo">Upload Profile Photo:</label>
        <input type="file" enctype="multipart/form-data" name="profile_photo"
          <?php if (isset($_SESSION["status"]["profile_photo"])) {
            echo "class='{$_SESSION["status"]["profile_photo"]}'";
            if (isset($_SESSION["profile_photo"])) {
              echo "value='{$_SESSION["profile_photo"]}'";
            };
          };
          ?> >
          <?php
            if (isset($_SESSION["errors"]["profile_photo"])) {
              echo "<p>{$_SESSION['errors']['profile_photo']}</p>";
            };
            if (isset($_SESSION["errors"]["upload_failed"])) {
              echo "<p class='error'>{$_SESSION['errors']['upload_failed']}</p>";
            };
          ?>
        <!-- Submit Button -->
        <input type="submit" name="submit" value="Submit">
      </form>
  </fieldset>
  </body>
</html>
