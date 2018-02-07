<?php
  session_start();

  if (!isset($_SESSION['counter'])){
    $_SESSION['counter'] = 1;
  } else {
    $_SESSION['counter'] += 1;
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Counter Demo</title>
  </head>
  <body>
    <h1>You visited this website</h1>
    <h2><?= $_SESSION['counter'] ?> times</h2>
  </body>
</html>
