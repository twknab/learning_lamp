<?php 
session_start();
require("new-connection.php");

// If no session send home:
if (!isset($_SESSION["user_id"])) {
  header("Location: index.php");
}

// Get current user info:
$query = "SELECT * FROM users WHERE id = ${_SESSION['user_id']}";
$user = fetch_record($query);

// Delete any password fields from user:
unset($user["password"]);
unset($user["salt"]);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>The Wall</title>
</head>
<body>
  <p>
    Welcome, <strong><?=$user["first_name"]?></strong>
    <form action="process.php" method="GET">
      <input type="hidden" name="form_type" value="logout">
      <input type="submit" value="Log Out">
    </form>
  </p>
  <h1>Post A Message</h1>
  <!-- New Message -->
  <form action="/process.php" method="POST">
  <input type="hidden" name="form_type" value="message">
  <textarea name="message" id="message" cols="30" rows="20"></textarea>
  <input type="submit" value="Post!">
  </form>
  <!-- Messages  -->
  <div>
    <strong>First Last - January 15th 2013</strong>
    <p>Fugiat fugiat nostrud ipsum nisi adipisicing sit est. Deserunt aliqua minim nostrud fugiat do aliquip quis ipsum Lorem officia fugiat cupidatat eiusmod. Irure et ullamco pariatur quis ut excepteur nulla dolor. Ex ut fugiat est aliqua sint est voluptate aute aute exercitation ad.</p>
    <!-- Comments -->
    <div>
      <p>Cupidatat est laboris sint ad magna velit eu et consectetur ut ut nulla sint.</p>
      <p>Cupidatat est laboris sint ad magna velit eu et consectetur ut ut nulla sint.</p>
    </div>
    <h5>Post a Comment</h5>
    <!-- New Comment  -->
    <div>
      <form action="/process.php" method="POST">
        <input type="hidden" name="form_type" value="comment">
        <textarea name="comment" id="comment" cols="30" rows="20"></textarea>
        <input type="submit" value="Comment!">
      </form>
    </div>
  </div>
</body>
</html>