<?php 
session_start(); // start session
require("new-connection.php"); // establish mysql connection to db

/**************************/
/*---- HELPER METHODS ----*/
/**************************/
// Create a helper method:
$__h = array(
  "isAlpha" => function ($string, $name, $error, $error_field) {
    /*
    If a string contains only letters (a-z and A-Z), returns true. Otherwise adds error to session and return false.

    Parameters:
    - $string = string to be analyzed.
    - $name = name to be included in error message.
    - $error = Type of error to which validation belongs (e.g. reg_errors, login_errors, etc)
    - `$error_field` = Field to which error belongs.
    */
    // Check if string is alphanumeric or not:
    if (preg_match('~^[a-zA-Z]*$~', $string) === 0) {
      // Add error:
      $_SESSION["${error}"]["${error_field}"][] = "🔍  ${name} must be letters only.";
      return FALSE;
    } else {
      return TRUE;
    }
  },
  "isEmailValid" => function ($string, $error) {
    /*
    If a string contains a valid email formatting,  return true. Otherwise adds error to session and return false.

    Parameters:
    - $string = string to be analyzed.
    - $error = Type of error to which validation belongs (e.g. reg_errors, login_errors, etc)
    */
    // Check if email is valid format or not:
      if (preg_match('~^[\w\.+_-]+@[\w\._-]+\.[\w]*$~', $string) === 0) {
        // Add error:
      $_SESSION["${error}"]["email"][] = "✏️  Email is incorrect format.";
      return FALSE;
    } else {
      return TRUE;
    }
  },
  "minLength" => function ($string, $min, $name, $error, $error_field) {
    /*
    If a string is less than min value, returns false. If string is at least or greater than min value, return true.

    Parameters:
    - $string = string to be analyzed.
    - $min = minimum value of string allowed
    - $name = name to be included in error message.
    - $error = Type of error to which validation belongs (e.g. reg_errors, login_errors, etc)
    - `$error_field` = Field to which error belongs.
    */

    if (strlen($string) < $min) {
      $_SESSION["${error}"]["${error_field}"][] = "💬  ${name} must be at least ${min} characters long.";
      return FALSE;
    } else {
      return TRUE;
    }
  },
  "confirmMatchingPasswords" => function () {
    /*
    If password and confirmation password do not match, return false, otherwise return true.
    */

    if ($_POST["password"] !== $_POST["password_confirm"]) {
      $_SESSION["reg_errors"]["password"][] = "🔒  Password and Password Confirmation fields must match.";
      return FALSE;
    } else {
      return TRUE;
    }
  },
  "isDuplicateUsername" => function ($username, $error, $error_field) {
    /*
    Checks if duplicate username is found or not. Returns true if duplicate is found.

    Parameter:
    - `$username` = User to search for duplicates
    - `$error` = Type of error to which validation belongs (e.g. reg_errors, login_errors, etc)
    - `$error_field` = Field to which error belongs.
    */

    // Retrieve user based upon username submitted:
    $user_query = "SELECT * FROM users WHERE users.username = '${username}'";
    $found_user = fetch_record($user_query);
    if (!empty($found_user)) { // if user is found:
      $_SESSION["${error}"]["${error_field}"][] = "🤷‍♂️ Username is taken.";
      return TRUE;
    } else {
      return FALSE;
    }
  },
  "validateLogin" => function ($username, $password) {
    /*
    If password entered matches user's decrypted password, redirects to login page (returns nothing and kills this page), otherwise, generates error and returns to index (killing this page). Nothing is returned.

    Parameter:
    - `$password` = User input password to be validated.
    - `$username` = User to compare to input'd password to
    */
    // Retrieve user based upon username submitted:
    // Development Note: I should probably take advantage of the isDuplicateUsername function above (which queries for a user for me), but I was too lazy at the time of writing this to refactor
    $user_query = "SELECT * FROM users WHERE users.username = '${username}'";
    $found_user = fetch_record($user_query);
    if (!empty($found_user)) { // if user is found:
      // use submitted (from login attempt) and has from retr'vd user to make encryption key:
      $encrypted_password = md5($password . "" . $found_user["salt"]);
      // if encryption key matches the key stored for the user, it's a match!
      if ($found_user["password"] == $encrypted_password) {
        // Destroy the sessions storage for the login:
        unset($_SESSION["login"]);
        // Set session user_id to the user_id:
        $_SESSION["user_id"] = $found_user["id"];
        // Send to dashboard and kill this file:
        header("Location: dashboard.php");
        die();
      } else { // user supplied password is invalid (wrong password)
        // Note: this error message is NOT intended to reveal whether user does not exist, or password mismatch. Not including this information is aimed to minimize malicious login attempts.
        // Send back error:
        $_SESSION["login_errors"]["failed_login"][] = "⚠️ Invalid Login.";
        // Send back to index:
        header("Location: index.php#login");
        die();
      }
    } else { // username does not exist (no user)
      // Note: this error message is NOT intended to reveal whether user does not exist, or password mismatch. Not including this information is aimed to minimize malicious login attempts.
      $_SESSION["login_errors"]["failed_login"][] = "⚠️ Invalid Login.";
      // Send back to index:
      header("Location: index.php#login");
      die();
    }
  },
);

/**************************/
/*-----    REGISTER   ----*/
/**************************/
/* Validate Registration:
  - escape strings!
  - no fields may be blank
  - fist and last name must contain only letters
  - first and last names must be at least 2 characters long
  - email must be valid
  - password must be at least 8 characters long
  - password and password confirmation must match
  - encrypt password w/ salt before storage
*/

// If POST method determined, and the registration form_type key exists and has been submitted:
if ($_POST && isset($_POST["form_type"]) && $_POST["form_type"] === "registration") {
    // Store registration data for filling back in registration form if error'd (so user doesn't have to fill out again):
    $_SESSION["registration"] = $_POST; // we'll destroy this after successful login
    unset($_SESSION["registration"]["password"]); // remove this field for security from our session storage
    unset($_SESSION["registration"]["password_confirm"]); // remove this field for security from our session storage
    $_SESSION["reg_errors"] = array(); // creates errors array (or resets it if new submission is sent)


    // Loop through $_POST array:
    foreach ($_POST as $form_item => $value) {
      // If type of submitted data is not a string or less than 1:
      if (gettype($value) !== "string" || strlen($value) < 1) {
        $_SESSION["reg_errors"]["all_fields"][] = "🖕 All fields must be filled out.";
        // Immediately return home;
        header("Location: index.php");
        die();
      }

      // Else all fields are filled out: using switch statement, examine each submitted field for further validation:
      else {

        switch ($form_item) {
          case "username":
            // Generate errors for min length or if username is anything but letters:
            $__h["isDuplicateUsername"]($value, "reg_errors", "username");
            $__h["minLength"]($value, 2, "Username", "reg_errors", "username");
            $__h["isAlpha"]($value, "Username", "reg_errors", "username");
            break;
          case "first_name":
            // Generate errors for min length or if first name is anything but letters:
            $__h["minLength"]($value, 2, "First Name", "reg_errors", "name");
            $__h["isAlpha"]($value, "First name", "reg_errors", "name");
            break;
          case "last_name":
            // Generate errors for min length or if last name is anything but letters:
            $__h["minLength"]($value, 2, "Last Name", "reg_errors", "name");
            $__h["isAlpha"]($value, "Last name", "reg_errors", "name");
            break;
          case "email":
            // Check if email is valid format or not:
            $__h["isEmailValid"]($value, "reg_errors");
            break;
          case "password":
            // Ensure min length of password:
            $__h["minLength"]($value, 8, "Password", "reg_errors", "password");
            break;
          case "password_confirm":
            // Ensure min length of password_confirmation:
            $__h["minLength"]($value, 8, "Password Confirmation", "reg_errors", "password");
            $__h["confirmMatchingPasswords"]();
            break;
        }

        // Modify the form value to be an escaped string:
        $_POST[$form_item] = escape_this_string($value);
      }

    }

  // Check for errors:
  if (count($_SESSION["reg_errors"]) > 0) {
    // errors detected, send back to index:
    header("Location: index.php");
  }  else {
      // Generate salt, encrypt password and combine:
      // Note: this is NOT the most secure but for practice:
      $salt = bin2hex(openssl_random_pseudo_bytes(22));
      $encrypted_password = md5($_POST["password"] . "" . $salt);
      // Write mysql query:
      $query = "INSERT INTO users (username, first_name, last_name, email, password, salt, created_at, updated_at) VALUES ('${_POST['username']}', '${_POST['first_name']}', '${_POST['last_name']}', '${_POST['email']}', '${encrypted_password}', '${salt}', NOW(), NOW())";
      // Send validated user to DB to be created:
      $user_id = run_mysql_query($query);
      if ($user_id) {
        // User successfully created, destroy registration data in session, add user id to session, redirect to dashboard.php:
        
        // Destroy registration form in sesssion:
        unset($_SESSION["registration"]);
        // Set session variable to user id:
        $_SESSION["user_id"] = $user_id;
        // Send to dashboard.php
        header("Location: dashboard.php");
        die();
      }
      else {
        $_SESSION["reg_errors"]["failed_reg"][] = "😣  Registration failed due to server issue. Contact administrator.";
        header("Locaton: index.php");
        die();
      }
  }
}



/**************************/
/*-----     LOGIN     ----*/
/**************************/
/* Validate Login:
  - escape strings!
  - username must exist
  - decrypted password must match user input password.
  - username and password input cannot be blank
*/

// If POST method determined, and the login form_type key exists and has been submitted:
else if ($_POST && isset($_POST["form_type"]) && $_POST["form_type"] === "login") {
  // Store login data for filling back in login form if error'd (so user doesn't have to fill out again):
  $_SESSION["login"] = $_POST; // we'll destroy this after successful login
  unset($_SESSION["login"]["password"]); // we will remove the password however from this imprint
  $_SESSION["login_errors"] = array(); // creates errors array (or resets it if new submission is sent)


  // Loop through $_POST array:
  foreach ($_POST as $form_item => $value) {
    // If type of submitted data is not a string or less than 1:
    if (gettype($value) !== "string" || strlen($value) < 1) {
      $_SESSION["login_errors"]["all_fields"][] = "🖕 All fields must be filled out.";
      // Immediately return home;
      header("Location: index.php");
      die();
    }

    // Else all fields are filled out: using switch statement, examine each submitted field for further validation:
    else {

      switch ($form_item) {
        case "login-username":
          // Generate errors for min length or if username is anything but letters:
          $__h["minLength"]($value, 2, "Username", "login_errors", "username");
          $__h["isAlpha"]($value, "Username", "login_errors", "username");
          break;
        case "login-password":
          // Ensure min length of password:
          $__h["minLength"]($value, 8, "Password", "login_errors", "password");
          break;
      }

      // Modify the form value to be an escaped string:
      $_POST[$form_item] = escape_this_string($value);
    }

  }

  // Check for errors:
  if (count($_SESSION["login_errors"]) > 0) {
  // errors detected, send back to index:
  header("Location: index.php#login");
  }  else {
   // If fields passed basic validations, validate password:
   $__h["validateLogin"]($_POST["login-username"], $_POST["login-password"]);
   // The above function will redirect for us.
   // If user is valid => dashboard
   // else, => index w/ errors
  }

}

/**************************/
/*-----    LOG OFF    ----*/
/**************************/
// Log Off:

// If GET method determined, and the logoff form_type key exists and has been submitted:
else if ($_GET && isset($_GET["form_type"]) && $_GET["form_type"] === "logoff") {
  // Let a user Logout (destroy session and send back to login page:)
  session_destroy();
  header("Location: index.php");
  die();
}

// Otherwise, reload index php:
else {
  // header("Location: index.php");
};