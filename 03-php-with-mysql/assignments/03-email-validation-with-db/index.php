<?php 
  session_start();
  require("new-connection.php"); // establish mysql connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Email Validation with DB</title>
    <style>
    .error {
      padding: 20px;
      margin: 20px 0 30px 0;
      background-color: pink;
    }
  </style>
</head>
<body>
  <h1>Email Validation with Database</h1>
  <?php  
    if ($_SESSION && isset($_SESSION["success"]) !== TRUE && isset($_SESSION["message"])) 
    {
      echo "<div class='error'>";
      echo $_SESSION["message"];
      echo "</div>";
    }
  ?>
  <fieldset><legend>Add New Email Address</legend>
    <form action="process.php" method="POST">
      Email Address: <input type="email" name="email" id="email">
      <input type="submit" value="Submit">
    </form>
  </fieldset>
</body>
</html>