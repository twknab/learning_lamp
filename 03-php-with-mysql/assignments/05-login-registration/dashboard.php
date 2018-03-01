<?php 
session_start(); // start session
require("new-connection.php"); // establish mysql connection to db

// If user is not yet logged in, send back to index:
if (!isset($_SESSION["user_id"])) {
  header("Location: index.php");
}

// Get current user info:
$query = "SELECT * FROM users WHERE id = ${_SESSION['user_id']}";
$user = fetch_record($query);

// Allow user to logoff:

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Dashboard</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body id="dashboard">
<h1 class="dash-header"><ico class="ico">💃🏽</ico> Congratulations! You made it to the Secret Layer!</h1>
  <fieldset id="user-info">
    <legend><h1>👤 User Info</h1></legend>
    <?php if ($user) { ?>
    <ul class="errors">
      <li>User Id: <?= $user["id"] ?> </li>
      <li>Username: <?= $user["username"] ?></li>
      <li>First Name: <?= $user["first_name"] ?></li>
      <li>Last Name: <?= $user["last_name"] ?></li>
      <li>Email: <?= $user["email"] ?></li>
      <li>Created: <?= date_format(date_create($user["created_at"]), 'm/d/Y \a\t h:iA') ?></li>
    </ul>
    <?php } ?>
  </fieldset>
  <form action="process.php" method="GET">
    <input type="hidden" name="form_type" value="logoff">
    <input type="submit" value="🔒  Log Off">
  </form>
  <h1 id="genie"><ico class="ico">🧞‍♂️</ico></h1>
</body>
</html>