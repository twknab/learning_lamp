<?php  
session_start();
require("new-connection.php");
// If post is submitted:
if ($_POST) {
    // Check if delete method submitted:
    if (isset($_POST["id"])) {
      // Run delete query
      $query = "DELETE FROM emails WHERE id = ${_POST['id']}";
      run_mysql_query($query);
      $_SESSION["message"] = "Email address deleted!";
      unset($_SESSION["success"]);
      header("Location: index.php");
    } else { // Otherwise must be new email submission
      // Check if email is valid (if email does NOT match pattern):
      if (preg_match('~^[\w\.+_-]+@[\w\._-]+\.[\w]*$~', $_POST["email"]) === 0) {
          // Add error:
          $_SESSION["message"] = "Email is incorrect format.";
          header("Location: index.php");
      } else {
        // Add to DB:
        $query = "INSERT INTO emails(email_address, created_at, updated_at) VALUES('${_POST['email']}', NOW(), NOW())";
        // If successful, add message and send to success.php:
        if (run_mysql_query($query)) {
            // Otherwise set message to success:
            $_SESSION["message"] = "The email address you entered (${_POST['email']}) is a VALID email address. Thank you!";
            $_SESSION["success"] = TRUE;
            // Send to success.php:
            header("Location: success.php");
        } else {
          $_SESSION['message'] = "Failed to add new Person";
          header("Location: index.php");
        }
      }
    }
  }
