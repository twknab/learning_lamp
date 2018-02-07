<?php
session_start(); // starts session

// Allow the user to only access this page if they are NOT logged in with a valid session. If valid session, redirect to homepage.

  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
    header('Location: home.php'); // will direct user to home.php
  } else {
    // Otherwise, no session detected. Set some session data:
    $_SESSION['logged_in'] = TRUE;
    $_SESSION['name'] = "Tim";
    $_SESSION['id'] = 1;
  }

?>
<h1>Login</h1>
