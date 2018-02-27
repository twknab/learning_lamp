<?php 
// In PHP, with MySQL databases specifically, we have to worry about SQL injection. SQL injection is a malicious hacking attempt where unauthorized SQL code is injected into your application. This could fill up your database with non-sensical values, or worse.

// Another method is where by an SQL query is written directly into a form field -- and upon submission, this is taken literally, messing up one's DB.

// Let's say you had the following function:
require("new_connection.php"); // gets connection file
function login($email, $password) {
  $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password`";
  $user = fetch_record($query);
  if ($user) {
    echo "You are logged in!";
  } else {
    echo "Error! Wrong email and password!";
  };
  echo $query;
}

// What might happen if someone submitted to the form:

  // email = `-0||`
  // password = 1

// This would send the following statement to the DB:
$new_query = "SELECT * FROM users WHERE email = '-0||' AND password = '1'";
// Essentially, by including quotations or backticks, a user might be able to send data to our query that returns (or injects) something not shady.

// Instead what we can do is use a function that's built into our connection file to help "escape our string". Escaping our string escapes any special characters in a string and is commonly used in an SQL statement.

// Here's how:

// We would pull our `new-connection.php` page here, but we've already done that:
function login_again($email, $password) {
  $esc_email = escape_this_string($email);
  $esc_password = escape_this_string($password);
  $query = "SELECT * FROM users WHERE email = '$esc_email' AND password = '$esc_password'";
  $user = fetch_record($query);
  if ($user) {
    echo "You are logged in! <br/>";
  } else {
    echo "ERROR! Wrong email and password. <br/>";
  }
  echo $query;
}

// By using escaped strings, anything submitted to the database will be as a string and not a malicious query.

// With the new code setup, that same submission:

// email = `-0||`
// password = `1`

// Will read as:

$escaped_query = "SELECT * FROM users WHERE email = '\-0||\' AND password = '1'";

// A good rule of thumb is to escape any data that the user submits.
?>