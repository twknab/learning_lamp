<?php
session_start();
// Profile page displays the user's information depending upon the user's session id.

if ( !array_key_exists('logged_in', $_SESSION) ) {
  header('Location: login.php');
} else {
  echo "<p>" . $_SESSION["id"] . "</p>";
  echo "<p>" . $_SESSION["name"] . "</p>";
}

?>
<h1>profile</h1>
