<?php session_start(); ?>
<!-- to start a session, we have to add the above first.. -->
<!-- `session_start()` MUST BE THE FIRST LINE IN THE DOCUMENT -->
<!-- Even a comment like this, will break your code and give you an error! -->

<!-- What does session_start() do? A unique session id for a user, if no session id is present, will automatically be generated. -->

<!-- We can view the session_id() here -->
<?php echo session_id(); ?>

<!-- The most interesting thing is that if you create another file, and try an create a new session, the **SAME** session ID will come up. -->

<!-- Checkout `another_assignment.php` for an example of this -->

<?php echo "<p>See `another_assignment.php` in this same folder, to see how one session on the same apache server remembers the user as long as they don't close the browser. Read the comments there and when done, come back here.</p>"; ?>

<!-- You can add meaningful values to session, once you initialize it, the same was as in Python or JS: -->

<?php
$_SESSION["name"] = "Tim";
$_SESSION["user_id"] = "58420234923990087";

// These can of course be retrieved like any other item:
echo "<p>" . $_SESSION["name"] . "</p>";
echo "<p>" . $_SESSION["user_id"] . "</p>";

// We can destroy stuff from session like this:
unset($_SESSION["name"]); // removes "name" key value pair.
$_SESSION = array(); // removes all $_SESSION variables.
session_destroy(); // destroys all session data
?>

<!-- In addition to SESSION, we can also create COOKIES: -->
<?php
  setcookie("foo", "bar", time() + 86400 * 30, '/');
  // `foo` is cookie name
  // `bar` is foo's value (optional)
  // `time() + 86400 * 30` sets cookie to expire in 30 days. If omitted cookie will expire when browser closes.
  // `/` means that the cookie will be available for the entire domain (path) -- also optional.

  // IMPORTANT NOTE -- IMPORTANT NOTE -- IMPORTANT NOTE:
  // setcookie() MUST appear BEFORE <html> tag!!!!
?>

<!-- We can retrieve cookies like this: -->
<?php
  echo $_COOKIE["foo"]; // will print `bar`
?>

<!-- Remember to NEVER store sensitive information in a cookie. The information is stored on a user's computer and easily exposed. -->
