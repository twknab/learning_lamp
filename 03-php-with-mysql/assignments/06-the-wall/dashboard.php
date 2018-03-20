<?php 
session_start();
require("new-connection.php");
require("process-dashboard.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="styles.css">
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
  <?php 
  if (isset($_SESSION["message_errors"]) && $_SESSION["message_errors"]) {
    foreach ($_SESSION["message_errors"] as $message) {
   ?>
    <div class="err">
      <p><?=$message?></p>
    </div>
  <?php 
    }
  }
  ?>
  <input type="hidden" name="form_type" value="message">
  <textarea name="message" id="message" cols="35" rows="20"></textarea>
  <input type="submit" value="Post!">
  </form>
  <!-- Messages  -->
  <div id="messages">
    <?php 
    foreach ($messages as $post) {
    ?>
    <div class="msg">
      <strong><?=$post['first_name'] . " " . $post['last_name']?> - <?=date_format(date_create($post["created_at"]), 'F jS Y')?></strong>
      <p><?=$post['message']?></p>
    </div>
    <div class="comments">
      <!-- Comments -->
      <?php foreach ($comments as $comment) {
        if ($comment['message_id'] === $post['message_id']) {
      ?>
        <div>
          <strong><?=$post['first_name'] . " " . $comment['last_name']?> - <?=date_format(date_create($comment["created_at"]), 'F jS Y')?></strong>
          <p><?=$comment['comment']?></p>
        </div>
      <?php
        }
      } ?>
      <h5>Post a Comment</h5>
      <!-- New Comment  -->
      <form action="/process.php" method="POST">
        <input type="hidden" name="form_type" value="comment">
        <input type="hidden" name="message_id" value="<?=$post['message_id']?>">
        <textarea name="comment" id="comment" cols="30" rows="10"></textarea>
        <input type="submit" value="Comment!">
      </form>
    </div>
    <?php } ?>
  </div>
</body>
</html>