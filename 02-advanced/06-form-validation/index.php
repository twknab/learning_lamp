<?php
session_start();
if (isset($_SESSION['errors']))
{
    foreach($_SESSION['errors'] as $error)
    {
        echo "<p>". $error. "</p>";
    }
}
?>
<form action='process.php' method='post'>
    Name: <input type='text' name='name'>
    City: <input type='text' name='city'>
    <input type='hidden' name='action' value='register'>
    <input type='submit' value='sign up!'>
</form>
