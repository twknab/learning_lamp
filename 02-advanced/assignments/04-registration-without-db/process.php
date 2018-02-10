<?php
session_start();

// Setup our upload directory:
$target_dir = 'upload/';

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

  if ($_FILES["profile_photo"]["name"]){
    $_SESSION["success"] = "YESAHH";
    // if no errors:
    if (!$_FILES["profile_photo"]["error"]) {

      // modify future file and validate:
      $new_file_name = strtolower($_FILES["profile_photo"]["tmp_name"]); // renames file

      // Can't be larger than 1MB
      if ($_FILES["profile_photo"]["size"] > (1024000)) {
        $_SESSION["errors"]["profile_photo"] = "Oops! Your file's size is too large (cannot be greater than 1MB).";
        $_SESSION["status"]["profile_photo"] = "error";
      }
    }

    $_SESSION["file_info"] = array();
    $_SESSION["file_info"][] = $_FILES['profile_photo']['name'];
    $_SESSION["file_info"][] = $_FILES['profile_photo']['size'];
    $_SESSION["file_info"][] = $_FILES['profile_photo']['type'];
    $_SESSION["file_info"][] = $_FILES['profile_photo']['tmp_name'];
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
      $currentdir = getcwd();
      $target = $currentdir ."/upload/" . basename($_FILES["profile_photo"]["name"]);
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
