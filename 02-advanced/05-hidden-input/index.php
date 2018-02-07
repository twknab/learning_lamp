<!-- Hidden inputs can be helpful in the event that we wish to handle 2 forms using the same `process.php` (or whatever we call it). Take a look at the example below, and see the corresponding `process.php` file in this same project folder -->

<form method="post" action="process.php">
    <input type="hidden" name="action" value="register">
    <!-- Notice the value of `register` above -->
    <input type="text" name="first_name">
    <input type="text" name="last_name">
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit" value="Register">
</form>
<form method="post" action="process.php">
    <input type="hidden" name="action" value="login">
    <!-- Notice the value of `login` above -->
    <input type="text" name="email">
    <input type="password" name="password">
    <input type="submit" value="Login">
</form>
