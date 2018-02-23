<?php  
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>QuotingDojo - Add Quote</title>
  <style>
    .error {
      background-color: pink;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>Welcome to QuotingDojo</h1>
  <fieldset><legend><h2>Add a Quote:</h2></legend>
    <?php  
      if (isset($_SESSION["errors"])) {
        foreach ($_SESSION["errors"] as $error => $message) {
          echo "<div class='error'>${message}</div>";
        }
      }
    ?>
    <form action="process.php" method="POST">
      <h4>Your Name:</h4>
      <input type="text" name="name">
      <h4>Your Quote:</h4>
      <textarea name="quote" id="quote" cols="30" rows="30"></textarea>
      <input type="submit" value="Add My Quote!">
      <input type="hidden" name="form_type" value="skip_to_quotes">
      <input type="submit" formaction="process.php" formmethod="GET" value="Skip To Quotes" >
    </form>
  </fieldset>
</body>
</html>