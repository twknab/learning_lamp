<?php
/*
A few notes: When we start MAMP we also run a MySQL server. We can use MySQL workbench to create or manipulate schemas, conneceting to our MySQL server. This is covered more in depth in the `learning-python` repository of mine.

We can also use phpMyAdmin to manipulate our data, if we don't have MySQL Workbench installed (this is cool):

Load in your browser: http://localhost:8888/phpMyAdmin

As we proceed, just understand that MAMP creates a MySQL server, and we then either use MySQL Workbench, or phpMyAdmin to connect to our server, and create or manipulate schemas and entries. Note that databases when developing are stored locally on our machine, by MAMP. MySQL Workbench and phpMyAdmin are just tools for us to visually or syntactically, CRUD (create, read, update, destroy) schemas.
*/

// How to Connect to a MySQL Database:

// Step 1: Turn on MAMP and confirm MySQL server is up and running.

// Step 2: Let's create some "constant" variables (Note: constant variables cannot be changed once defined and are immutable).

define("DB_HOST", "localhost"); // defines DB_HOST as "localhost" (the server address)
define("DB_USER", "root"); // defines DB_USER as root
define("DB_PASS", "root"); // set DB_PASS as whatever is string
define("DB_DATABASE", "my_first_php_db"); // set DB_DATABASE as my_first_php_db

// Connect to database:
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);

/*
This creates a connection to the mysql database using a built-in extension called `mysqli()`. See these links for more info about the mysqli() extension, how to use it, and how to connect to a DB.

https://secure.php.net/manual/en/book.mysqli.php
https://secure.php.net/manual/en/mysqli.quickstart.connections.php
*/

// Note: If multiple files need access to the DB, they can "require()" or "include()" this file, to obtain that connection. You definitely *do not* need to insert this code into each document.

// Let's take a look at our connection object:
echo "<fieldset><legend><h1>Connection Info:</h1></legend>";
var_dump($connection);
echo "</fieldset>";

// Let's take a look at any errors:
echo "<fieldset><legend><h2>Error Info:</h2></legend>";
if($connection->connect_errno)
{
  echo "Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error;
  // Kill server
  die("Failed to connect to MySQL: (" . $connection->connect_errno . ") " . $connection->connect_error);
}
echo "</fieldset>";

// We can query our DB here:
echo "<fieldset><legend><h2>Database Queries:</h2></legend>";
$users = $connection->query("SELECT * FROM users");
var_dump($users);
// Loop through $users object:
foreach($users as $user) {
  var_dump($user);
}
echo "</fieldset>";


?>
