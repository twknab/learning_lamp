<?php
  session_start();
  require("new-connection.php");
  // Get all Students:
  $query = "SELECT * FROM emails";
  $students = fetch_all($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Success!</title>
  <style>
    .success {
      padding: 20px;
      margin: 20px 0 30px 0;
      background-color: lightgreen;
    }
  </style>
</head>
<body>
  <h1>Success!</h1>
  <div class="success">
    <?php 
      if (isset($_SESSION["message"])) { 
        echo $_SESSION["message"];
      } 
    ?>
  </div>
  <fieldset><legend>Email Addresses Entered:</legend>
    <table>
      <?php foreach ($students as $student) { ?>
      <tr>
        <td><?= $student["email_address"] ?></td>
        <td><?= date_format(date_create($student["created_at"]), 'm/d/Y h:iA') ?></td>
        <td>
          <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?= $student['id'] ?>">
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      <?php } ?>
    </table>
  </fieldset>
  <a href="index.php">Add Another Email Address</a>
</body>
</html>