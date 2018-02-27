<?php 
/*
We already know about encryption, having use bCrypt a variety of times.

In this portion of the LAMP stack, we're going to bring in encryption, starting with md5 (not as secure as bcrypt).

md5 is a native function to PHP--not industry standard--but a good place to start with an example.
*/

$password = "myPass";
$encrypted_password = md5($password);
echo $encrypted_password . "<br>";
// This will return the same has for the same argument given, every time.


// In the scenario of wanting to add a new user to your database, you'd want to encrypt your incoming password, like this:
require("new-connection.php");
$_POST["password"] = "myUnencryptedPassword";
$_POST["email"] = "julianna@giles.com";
$_POST["username"] = "jGiles";
$password = md5($_POST["password"]);
$email = escape_this_string($_POST['email']);
$username = escape_this_string($_POST['username']);
$query = "INSERT INTO users (username, email, password, created_at, updated_at) VALUES ('${username}', '${password}', NOW(), NOW())";
run_mysql_query($query); // would run the query sending the encrpyted password along, not the original string.

// You already know the importance of this but worth discussing for this stack.

// Try increasing your security by adding a salt to your encrpytion (otherwise every computer would get the same result):
$salt = bin2hex(openssl_random_pseudo_bytes(22));
echo $salt;

// Now let's try the registration process again adding our salt:
// Note that our $_POST values are still coming from above since we're not actually submitting any forms here.
$username = escape_this_string($_POST["username"]);
$email = escape_this_string($_POST["email"]);
$password = escape_this_string($_POST["password"]);
$salt = bin2hex(openssl_random_pseudo(22));
$encrypted_password = md5($password . "" . $salt); // add salt to our encrpyted value
$query = "INSERT INTO users (username, email, password, salt, created_at, updated_at) VALUES ('${username}', '${email}', '${encrypted_password}', '${salt}', NOW(), NOW())";
run_mysql_query($query);



// How would we validate this same information on a login?
$email = escape_this_string($_POST['email']);
$password = escape_this_string($_POST['password']);
$user_query = "SELECT * FROM users WHERE users.email = '${email}'";
$user = fetch_record($user_query);
if (!empty($user)) {
  $encrypted_password = md5($password . "" . $user["salt"]);
  if ($user["password"] == $encrypted_password) {
    // Do stuff with a successful login!
  } else {
    // NOT a succesful login!
  }
} else {
  // Invalid email!
}
?>