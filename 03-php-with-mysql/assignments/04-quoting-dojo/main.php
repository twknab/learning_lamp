<?php  
session_start();
require("new-connection.php"); // establish mysql connection
// Get all quotes:
$query = "SELECT * FROM quotes ORDER BY created_at DESC";
$quotes = fetch_all($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>QuotingDojo - View Quotes</title>
  <style>
    .quote {
      margin-left: 80px;
    }
  </style>
</head>
<body>
  <h1>Here are the awesome quotes!</h1>
  <form>
    <input type="hidden" name="form_type" value="back_to_add_quote">
    <input type="submit" formaction="process.php" formmethod="GET" value="Back to Add Quote">
  </form>
  <!-- Quotes ordered descending -->
  <?php  
    foreach ($quotes as $quote) { ?>
      <div>
        <blockquote>"<?= $quote["quote"] ?>"</blockquote>
        <p class="quote">-- <?= $quote["author"] ?> at <?= date_format(date_create($quote["created_at"]), ' g:ia F j Y') ?></p>
      </div>
    <? }
  ?>
</body>
</html>