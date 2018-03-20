<?php 
session_start();
require("new-connection.php");

// ***************************** //
// ** GLOBAL HELPER FUNCTIONS ** //
// ***************************** //
function alphaCheck($string, $error, $name) {
  if (preg_match('~^[a-zA-Z]*$~', $string) === 0) {
    // Add error:
    $_SESSION["${error}"][] = "${name} must be letters only.";
    return FALSE;
  } else {
    return TRUE;
  }
}

// ****************** //
// ** REGISTRATION ** //
// ****************** //
// ======================================================== //
// ======================================================== //
if ($_POST && isset($_POST["form_type"]) && $_POST["form_type"] === "register") {

  // Validate registration:
  $_SESSION["reg_errors"] = array();
  
  // Escape all fields pior to validation:
  foreach ($_POST as $field => $value) {
    $value = escape_this_string($value);
  }

  //%%%%%%%%%%%%/
  // ALL FIELDS
  //%%%%%%%%%%%%/
  if (count($_POST) < 6) {
    $_SESSION["reg_errors"][] = "All fields required.";
    header("Location: index.php"); // go straight home again
  }

  //%%%%%%%%%%%%/
  // FIRST & LAST NAME
  //%%%%%%%%%%%%/
  // Check min length of 2 char:
  if (strlen($_POST["first_name"]) < 2) {
    $_SESSION["reg_errors"][] = "First name must be at least 2 characters.";
  }
  if (strlen($_POST["last_name"]) < 2) {
    $_SESSION["reg_errors"][] = "Last name must be at least 2 characters.";
  }
  // Check for alpha only:
  alphaCheck($_POST["first_name"], "reg_errors", "First name");
  alphaCheck($_POST["last_name"], "reg_errors", "Last name");

  //%%%%%%%%%%%%/
  // EMAIL
  //%%%%%%%%%%%%/
  // Check min length of 5 char:
  if (strlen($_POST["email"]) < 5) {
    $_SESSION["reg_errors"][] = "Email must be at least 5 characters.";
  }
  // Make sure valid email:
  if (preg_match('~^[\w\.+_-]+@[\w\._-]+\.[\w]*$~', $_POST["email"]) === 0) {
    // Add error:
    $_SESSION["reg_errors"][] = "Email is incorrect format.";
  }
  // Check for duplicate user with that email:
  $user_query = "SELECT * FROM users WHERE users.email = '${_POST['email']}'";
  $found_user = fetch_record($user_query);
  if (!empty($found_user)) { // if user is found:
    $_SESSION["reg_errors"][] = "Email is already in use.";
  }

  //%%%%%%%%%%%%/
  // PASSWORD
  //%%%%%%%%%%%%/
  // Check min length:
  if (strlen($_POST["password"]) < 8 || strlen($_POST["confirm_password"]) < 8) {
    // Add error:
    $_SESSION["reg_errors"][] = "Password must be at least 8 characters.";
  }
  // Check if passwords match:
  if ($_POST["password"] !== $_POST["confirm_password"]) {
    // Add error:
    $_SESSION["reg_errors"][] = "Password and confirmation must match.";
  }

  //%%%%%%%%%%%%/
  // ERROR CHECK
  //%%%%%%%%%%%%/
  // If any errors were given, reload page:
  if (count($_SESSION["reg_errors"]) > 0) {
    header("Location: index.php");
    die();
  } 
  
  //%%%%%%%%%%%%/
  // FORM VALIDATED
  //%%%%%%%%%%%%/
  // Encrypt password:
  $salt = bin2hex(openssl_random_pseudo_bytes(22));
  $encrypted_password = md5($_POST["password"] . "" . $salt);

  // Write mysql query:
  $query = "INSERT INTO users (first_name, last_name, email, password, salt, created_at, updated_at) VALUES ('${_POST['first_name']}', '${_POST['last_name']}', '${_POST['email']}', '${encrypted_password}', '${salt}', NOW(), NOW())";

  // Send validated user to DB to be created:
  $user_id = run_mysql_query($query);
  
  
  // If User successfully created, add user id to session, redirect to dashboard.php:
  if ($user_id) {
    // Set session variable to user id:
    $_SESSION["user_id"] = $user_id;
    // Send to dashboard.php
    header("Location: dashboard.php");
    die();
  } else {
    $_SESSION["reg_errors"][] = "Registration failed due to server issue. Contact administrator.";
    header("Locaton: index.php");
    die();
  }
}


// ****************** //
// **     LOGIN    ** //
// ****************** //
// ======================================================== //
// ======================================================== //
if ($_POST && isset($_POST["form_type"]) && $_POST["form_type"] === "login") {

  // Validate login:
  $_SESSION["login_errors"] = array();
  
   // Escape all fields pior to validation:
  foreach ($_POST as $field => $value) {
    $value = escape_this_string($value);
  }

  //%%%%%%%%%%%%/
  // ALL FIELDS
  //%%%%%%%%%%%%/
  // Check all fields:
  if (count($_POST) < 3) {
    $_SESSION["login_errors"][] = "All fields required.";
  }

  //%%%%%%%%%%%%/
  // EMAIL
  //%%%%%%%%%%%%/
  if (strlen($_POST["email"]) < 5) {
    $_SESSION["login_errors"][] = "Email must be at least 5 characters";
  }

  //%%%%%%%%%%%%/
  // PASSWORD
  //%%%%%%%%%%%%/
  if (strlen($_POST["password"]) < 8) {
    $_SESSION["login_errors"][] = "Password must be at least 8 characters";
  }
  
  //%%%%%%%%%%%%/
  // FIND USER BY EMAIL AND VERIFY PASSWORD
  //%%%%%%%%%%%%/
  // Write query:
  $user_query = "SELECT * FROM users WHERE users.email = '${_POST['email']}'";
  
  // Fetch user:
  $found_user = fetch_record($user_query);

  // If user is found:
  if (!empty($found_user)) {
    // Join submitted password and retreived user's salt:
    $encrypted_password = md5($_POST["password"] . "" . $found_user["salt"]);

    // If encryption  matches the key for desired user, match is a success:

    if ($found_user["password"] == $encrypted_password) {
      // Set session user_id to the user_id:
      $_SESSION["user_id"] = $found_user["id"];
    } else { // Password incorrect:
      // Add error:
      $_SESSION["login_errors"][] = "Invalid Login.";
    }
  } else { // Username not found:
    // Add error:
    $_SESSION["login_errors"][] = "Invalid Login.";
  }


  //%%%%%%%%%%%%/
  // ERROR CHECK
  //%%%%%%%%%%%%/
  // If any errors were given, reload page:
  if (count($_SESSION["login_errors"]) > 0) {
    header("Location: index.php");
    die();
  }

  //%%%%%%%%%%%%/
  // FORM VALIDATED
  //%%%%%%%%%%%%/
  // User validated, load dashboard:
  header("Location: dashboard.php");
  die();
}

// ****************** //
// **    MESSAGE   ** //
// ****************** //
// ======================================================== //
// ======================================================== //
if ($_POST && isset($_POST["form_type"]) && $_POST["form_type"] === "message") {
  // Validate login:
  $_SESSION["message_errors"] = array();
  
   // Escape all fields pior to validation:
  foreach ($_POST as $field => $value) {
    $value = escape_this_string($value);
  }

  // If any errors were given, reload page:
  if (count($_SESSION["message_errors"]) > 0) {
    header("Location: dashboard.php");
  } else {
    // Form validated: 
    // Send to database (strings already escaped):
  }
}

// ****************** //
// **    COMMENT   ** //
// ****************** //
// ======================================================== //
// ======================================================== //
if ($_POST && isset($_POST["form_type"]) && $_POST["form_type"] === "comment") {
  // Validate login:
  $_SESSION["comment_errors"] = array();
  
   // Escape all fields pior to validation:
  foreach ($_POST as $field => $value) {
    $value = escape_this_string($value);
  }

  // If any errors were given, reload page:
  if (count($_SESSION["comment_errors"]) > 0) {
    header("Location: dashboard.php");
  } else {
    // Form validated: 
    // Send to database (strings already escaped):
  }
}

// ****************** //
// **    LOGOUT    ** //
// ****************** //
// ======================================================== //
// ======================================================== //
if ($_GET && isset($_GET["form_type"]) && $_GET["form_type"] === "logout") {
  // Destroy session:
  $_SESSION = [];
  // Go home:
  header("Location: index.php");
}