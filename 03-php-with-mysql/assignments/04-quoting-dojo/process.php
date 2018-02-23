<?php
session_start();
require("new-connection.php"); // establish mysql connection

// If POST submission:
/*
POST submission occurs only when "Add My Quote!" is clicked:
*/
if ($_POST) {
  // Create associated array to hold any errors:
  $_SESSION["errors"] = array();
  // Validate: Input Check (data type check):
  if (gettype($_POST["name"]) !== "string" || gettype($_POST["quote"]) !== "string") {
    $_SESSION["errors"]["name"] = "Invalid submission";
  }
  // Validate: Check Name Required:
  if (isset($_POST["name"]) && (strlen($_POST["name"]) < 1)) {
    $_SESSION["errors"]["name"] = "Name is required.";
  }
  // Validate: Check Quote Required:
  if (isset($_POST["quote"]) && (strlen($_POST["quote"]) < 2)) {
    $_SESSION["errors"]["quote"] = "Quote is required and must be at least 2 characters.";
  }
  // If any errors direct home:
  if (count($_SESSION["errors"]) > 0) {
    header("Location: index.php");
  } else { // Else, no errors:
    // Add Quote to DB
    $quote = "INSERT INTO quotes (quote, author, created_at, updated_at) VALUES ('${_POST['quote']}', '${_POST['name']}', NOW(), NOW())";
    if(run_mysql_query($quote)) {
      // Direct to Main
      header("Location: main.php");

    } else {
      echo "ERROR ERROR";
    }
  }
}
// If GET submission:
/*
GET submission can occur either by clicking "Skip to Quotes" on index.php, or "Back to Add Quote" on main.php.
*/
if ($_GET) {
  // If GET method is coming from "Skip To Quotes" form submission:
  if (isset($_GET["form_type"]) && $_GET["form_type"] === "skip_to_quotes") {
    // Reset any errors:
    resetErrors(); // see custom function below
    // Direct to Main:
    header("Location: main.php");
  }

  // If GET method is coming from "back_to_add_quote" form submission:
  if (isset($_GET["form_type"]) && $_GET["form_type"] === "back_to_add_quote") {
    // Reset any errors:
    resetErrors();
    // Direct to Index:
    header("Location: index.php");
  }

}

function resetErrors() {
  /*
  Resets errors if there are any:
  */
  if (isset($_SESSION["errors"])) {
    unset($_SESSION["errors"]);
  }
}