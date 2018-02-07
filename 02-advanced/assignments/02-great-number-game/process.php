<?php
session_start();

// If no existing session, generate a random number:
if (!isset($_SESSION["number"])) {
  // Generate a random number between 1-100 and store in session:
  $_SESSION["number"] = rand(1,100);
}

// If post is submitted, assign this value as the guess:
if ($_POST) {
  // If guess form is submitted:
  if ($_POST["action"] == "guess") {
    $_SESSION["guess"] = $_POST["guess"];
    // Redirect to index.php:
    header('Location: index.php');
  }

  // If reset form is submitted:
  if ($_POST["action"] == "reset") {
    // Destroy session:
    session_destroy();
    // Redirect to index.php:
    header('Location: index.php');
  }
}


?>
