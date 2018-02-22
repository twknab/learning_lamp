<?php  
  session_start();
  require("new-connection.php"); // loads our mysql database connection

  // Get All People Query -- MULTIPLE RECORDS:
  $people_query = "SELECT * FROM people";
  $people = fetch_all($people_query);

  // Get One Person Query -- SINGLE RECORD:
  $person_query = "SELECT * FROM people WHERE id = 1";
  $one_person = fetch_record($person_query);

  // See process.php for how to insert a record
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DB Communication</title>
</head>
<body>
<div style="padding: 20px; background-color: lightyellow;">
  <?php 
    if ($_SESSION && isset($_SESSION['message'])) {
      echo "<p>${_SESSION['message']}</p>";
    };
  ?>
</div>
<fieldset><legend>People</legend>
  <?php foreach ($people as $person) {
    echo "${person['first_name']} ${person['last_name']}" . "<br/>";
  } ?>
</fieldset>
<fieldset><legend>Person</legend>
  <?php 
    echo "${one_person['first_name']} ${one_person['last_name']} - ${one_person['id']}";
  ?>
</fieldset>
<fieldset><legend>Add a Person</legend>
  <form action="process.php" method="POST">
    First Name: <input type="text" name="first_name" id="first_name">
    Last Name: <input type="text" name="last_name" id="last_name">
    <input type="submit" value="Submit!">
  </form>
</fieldset>
</body>
</html>
 