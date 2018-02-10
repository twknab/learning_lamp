<?php
session_start();

if (!isset($_SESSION["registered"])) {
  header("Location: index.php");
  die();
}
?>
<h1>Registration Confirmed!</h1>
<h2>
  <?php if (isset($_SESSION["success"])) {
    echo $_SESSION["success"];
  } ?>
</h2>
