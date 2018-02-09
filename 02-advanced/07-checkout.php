<?php
/*
One thing to remember is that if you created a checkout application, that only used process.php to process the sale, there is a big design risk if your user was to refresh the page. Their order would be *resubmitted*, perhaps their card charged twice.

A good trick to get around this is to have process.php, strip the $_POST values from your form and store them in $_SESSION.

Then, redirect to a new php page, like `checkout.php`, which confirms the order. Refreshing this page will only grab information stored in session, and won't generate another order!
*/

// Like this:
$_SESSION["first_name"] = $_POST["first_name"];
$_SESSION["last_name"] = $_POST["last_name"];
$_SESSION["email"] = $_POST["email"];
$_SESSION["product"] = $_POST["product"];
$_SESSION["quantity"] = $_POST["quantity"];

// One more note about using header and `location`: always use `exit` or `die()`;
header('Location: checkout.php');
die(); // this kills the current `process.php` after sending over to `checkout.php`. Again, important for security.

?>
