<?php
  // List any GET related requests:
  if ($_GET) {
    echo "<h1>GET METHOD DETECTED</h1>";
    echo "<p>" . $_GET['first_name'] . "</p>";
    echo "<p>" . $_GET['last_name'] . "</p>";
    var_dump($_GET);
  }

  elseif ($_POST) {
    // List any POST related requests:
    echo "<h1>POST METHOD DETECTED!</h1>";
    echo "<p>" . $_POST['first_name'] . "</p>";
    echo "<p>" . $_POST['last_name'] . "</p>";
    var_dump ($_POST);
  }
?>
