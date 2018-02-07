<?php
session_start(); // needed on EVERY page using session

// Only allow user to access this page if logged in. Otherwise redirect to login page.

  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == TRUE) {
    // do nothing
  } else {
    // Otherwise, no session detected. Set some session data:
    header('Location: login.php');
  }

?>
<h1>Home</h1>
