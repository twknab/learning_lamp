<?php

if ($_POST){
  echo "<h1>Submitted Information</h1>";
  echo "<p>Name: " . $_POST["name"] . "</p>";
  echo "<p>Dojo Location: " . $_POST["location"] . "</p>";
  echo "<p>Favorite Language: " . $_POST["language"] . "</p>";
  echo "<p>Comment: " . $_POST["comment"] . "</p>";
  echo "<form method='GET' action='/02-advanced/assignments/01-survey-form/'>";
  echo "<input type='submit' value='Go Back'>";
  echo "</form>";
}

?>
