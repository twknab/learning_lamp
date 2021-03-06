<?php
session_start();

if ($_POST) {

  // * -----------------
  // * Field Validations:
  // * -----------------

  // Array to hold errors:
  $_SESSION["errors"] = array();
  // Array to hold status if success or failure (for front-end styling):
  $_SESSION["status"] = array();

  // *
  // * 1. First and Last Name
  // * First and last name must contain only letters.

  // First name and last name should not have any numbers:
  if (preg_match('~[0-9]~', $_POST["first_name"]) == 1) {
    // Add error for first name:
    $_SESSION["errors"]["first_name"] = "First name must not contain any numbers.";
    // Set status to error for first name:
    $_SESSION["status"]["first_name"] = "error";
  } else {
    // Otherwise set status to success for first name and save to session:
    $_SESSION["status"]["first_name"] = "success";
    $_SESSION["first_name"] = $_POST["first_name"];
  };
  if (preg_match('~[0-9]~', $_POST["last_name"]) == 1) {
    // Add error for last name:
    $_SESSION["errors"]["last_name"] = "Last name must not contain any numbers.";
    // Set status to error for last name:
    $_SESSION["status"]["last_name"] = "error";
  } else {
    // Otherwise set status to success for last name
    $_SESSION["status"]["last_name"] = "success";
    $_SESSION["last_name"] = $_POST["last_name"];
  };

  // *
  // * 2. Password
  // * Password must be greater than 6 characters and match confirmation.

  // If password is not greater than 6 characters:
  if (strlen($_POST["password"]) <= 6) {
    // Add error for password:
    $_SESSION["errors"]["password"] = "Password must be at least 7 characters.";
    // Set status to error for password:
    $_SESSION["status"]["password"] = "error";
  } else {
    // If password and confirmation password do not match:
    if ($_POST["password"] != $_POST["password_confirm"]) {
      // Add error for password and password confirmation:
      $_SESSION["errors"]["password"] = "Password and confirmation password must match.";
      $_SESSION["errors"]["password_confirm"] = "Password and confirmation password must match.";
      // Set status to error for password:
      $_SESSION["status"]["password"] = "error";
      $_SESSION["status"]["password_confirm"] = "error";
    };
  };

  // *
  // * 3. Email
  // *

  // If email is not greater than 5 characters:
  if (strlen($_POST["email"]) <= 5) {
    // Add error for email:
    $_SESSION["errors"]["email"] = "Email must be at least 6 characters.";
    // Set status to error for email:
    $_SESSION["status"]["email"] = "error";
  } else {
    // Otherwise set status to success for email
    $_SESSION["status"]["email"] = "success";
    $_SESSION["email"] = $_POST["email"];
  };

  // *
  // * 3. Birth Date
  // *

  // Check if birth date is not a valid date format:

  // Break birth date string into an array:
  $birth_date = explode("-", $_POST["birth_date"]);
  // If array does not contain full year, month, day:
  if (count($birth_date) < 3) {
    // Add error for birth_date:
    $_SESSION["errors"]["birth_date"] = "Birth date must be a valid date.";
    // Set status to error for birth_date:
    $_SESSION["status"]["birth_date"] = "error";
  } else { // If all fields are present, then check validity of date:
    if (checkdate((int)$birth_date[1], (int)$birth_date[2], (int)$birth_date[0]) != TRUE) {

      // Note regarding checkdate(): We have to feed the parameters in a different order than they are in the array, due to the requirements of the function. We could have manipulatd this array previously, rather than make this adjustment, but just wanted to keep moving. The native array format after explode is ["Y", "M", "d"]

      // Add error for birth_date:
      $_SESSION["errors"]["birth_date"] = "Birth date must be a valid date.";
      // Set status to error for birth_date:
      $_SESSION["status"]["birth_date"] = "error";
    } else {
      $_SESSION["status"]["birth_date"] = "success";
      $_SESSION["birth_date"] = $_POST["birth_date"];
    };
  };

  // *
  // * 4. Profile Photo
  // *
  // * Note: We use a superglobal, pre-defined variable called $_FILES to help
  // * upload, validate and store our file. See these links for more:
  // *
  // * http://php.net/manual/en/features.file-upload.post-method.php
  // * https://secure.php.net/manual/en/reserved.variables.files.php
  // * http://www.php.net/manual/en/features.file-upload.errors.php
  // * https://www.w3schools.com/php/php_file_upload.asp
  // *

  if ($_FILES["profile_photo"]["name"]){ // if photo is submitted:
    // Note:
    // Array keys:
    // - `profile_photo` is the name="" attribute in the HTML

    $_SESSION["files"] = $_FILES;

    // Setup our upload target path for our file:
    $currentdir = getcwd(); // gets current working directory
    $target = $currentdir ."/upload/" .  basename($_FILES["profile_photo"]["name"]); // defines target location

    // Note: It's good to do some validations of the actual file using, finfo, to ensure that this file is indeed an image, and no malicious scripts pretending to be an image. It is also a good idea to restrict only certain file types from being uploaded.

    // I was having trouble however, figuring out how to use finfo at the time of writing this code. I was also gathering some mixed suggestions on the proper way to *truly* verify a file. It seems that many common methods can be easily duped.

    // See: http://php.net/manual/en/function.finfo-file.php
    // http://php.net/manual/en/function.finfo-open.php

    // If no errors during temp upload:
    if (!$_FILES["profile_photo"]["error"]) {

      // Modify future file and validate:
      $new_file_name = strtolower($_FILES["profile_photo"]["tmp_name"]); // renames file

      // Check if file already exists:
      if (file_exists($target)) {
        $_SESSION["errors"]["profile_photo"] = "Oops! A file with this name already exists. Rename your file and try again.";
        $_SESSION["status"]["profile_photo"] = "error";
      };

      // Can't be larger than 5MB:
      if ($_FILES["profile_photo"]["size"] > (5242880)) {
        $_SESSION["errors"]["profile_photo"] = "Oops! Your file's size is too large (cannot be greater than 5MB).";
        $_SESSION["status"]["profile_photo"] = "error";
      };

    };
  } else { // If there's an error with temp upload:
    $_SESSION["errors"]["profile_photo"] = "Oops! Your file could not be uploaded. Please contact the administrator and describe your issue.";
    $_SESSION["status"]["profile_photo"] = "error";
  }



  // If errors, store to session and return to login (and iterate through errors highlighting error'd fields)
  if (count($_SESSION["errors"]) > 0) {
    header("Location: index.php");
    die();
  } else { // Else there are no errors:

    // This is where you'd store the values to the database!

    // If image is submitted, store it:
    if ($_FILES["profile_photo"]["name"]) {
      // Store the file by moving it to where we want it to be:
      move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target);
      $_SESSION["success"] = "Congratulations! Your file was accepted and you've been successfully registered.";

    } else {
        $_SESSION["success"] = "Congratulations! You've been successfully registered.";
    };

    // Reset statuses:
    $_SESSION["status"] = array();
    $_SESSION["registered"] = TRUE;

    // Then pass to confirmation page:
    header("Location: confirmation.php");
    die();
  };
} else { // if $_POST request is not made:
  header("Location: index.php");
  die();
}
?>
