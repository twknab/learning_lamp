<?php
// Here are some useful methods that might be convenient for validation:

isset($variable);
// returns TRUE if variable has a value (this includes 0, [], FALSE, or "" -- *any* value will return TRUE ). This will return FALSE if variable is not defined.

strlen($string);
// returns number of characters from a string (including spaces). Useful for password validation. Note, feeding strlen($numbers) will convert the numbers to a string.

is_numeric($string);
// returns TRUE if $string contains a number. Leading spaces are OK, "  123.04", but not trailing spaces ("56.78  ");

empty($variable);
// returns FALSE if the value of the variable EXISTS AND has value NOT equal to:
//  - an empty string or array
//  - FALSE
//  - NULL
//  - 0 or '0'

// You can also use this method as !empty($variable). Which is similar to `isset()`, except is stricter. For !empty(), the variable must also have a value not equal to any listed above in order for !empty() to return TRUE.

filter_var($string, FILTER_VALIDATE_EMAIL);
// Takes a string and a constant that represents a filter pattern, and returns TRUE if the string fits the pattern. (Regex). Otherwise returns FALSE. Use this pattern to validate emails or strings (passwords)!

// Store errors in $_SESSION['errors'], as key-value pairs. Iterate through them on the front end.

// Seperation of Concerns:

// You don't have to put everything into `process.php, in fact it's best to break things up into a seperation of concerns:

/*
account_process.php - handles login, register, logout, displaying member list, as well as showing and updating the profile page for each user.

message_process.php - handles creating, updating and deleting messages and comments.

like_process.php - handles creating and undoing likes.

survey_process.php - handles creating, retrieving, updating, and deleting surveys.
*/

?>
