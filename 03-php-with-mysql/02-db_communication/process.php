<?php 
session_start();
require("new-connection.php");
// Insert Something -- INSERT RECORD:
if ($_POST) {
    // create query
  $insert_query = "INSERT INTO people(first_name, last_name, `from`, `to`)
    VALUES('${_POST['first_name']}', '${_POST['last_name']}', NOW(), NOW())";
    // note the use of backticks (``) for the `from` and `to` fields.
    // since these reserved words are native SQL commands, this ensures these are not interpreted as such.
   
  // check if query successful
  if (run_mysql_query($insert_query)) {
    $_SESSION['message'] = "New Person has been added correctly!";
  } else {
    $_SESSION['message'] = "Failed to add new Person";
  }
    // reload page
  header('Location: index.php');
}