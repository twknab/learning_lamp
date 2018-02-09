<?php
session_start();

if ($_SESSION) {
  echo "<h1>Success!</h1>";
} else {
  $_SESSION['errors'][] = "must be logged in.";
  header('Location: index.php');
}
?>
