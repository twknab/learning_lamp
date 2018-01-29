<?php
// Conditionals evaluate if something is true or false.
// We use a variety of operators to make these comparisons.

// Some things to take note:
// By default, these values are "false":
$false = false; // this is obvious
$also_false = 0; // zero is actually false
$false_too = ""; // any empty string is false

// These are true:
$truth = true;
$also_true = 1;
$true_too = "Yo!";

// Here's how if/else statements are formatted in PHP:
if ($true_too == false)
{
  echo "Hey this is false!";
}
else
{
  echo "No, this is true!";
};

// Another example:
if ($truth == true && $false == false)
{
  echo "Both are indeed false!";
}
else
{
  echo "No, they are indeed not!";
};

// We can also do if/elseif/else statements, such as:
if ($truth == false)
{
  echo "Truth is actually false";
}
elseif ($false == true)
{
  echo "Falsity is truth!";
}
else
{
  echo "Neither of those are correct!";
}

// How about switch cases?
// This is very similar to JS:
$counter = 0;
switch($also_true)
{
  case false:
    echo "Is false!";
    $counter -= 1;
  break;
  case "Yo!":
    echo "Yo is correct!";
    $counter += 1;
  break;
  default:
    echo "Is neither!";
    $counter -= 1;
  break;
}

echo $counter;

// Here's a list of all operators and comparisons:
/*

== 	is equal to, comparison ex) 	$x == $y
!= 	is not equal to, comparison ex) 	$x != $y
< 	less than, comparison ex) 	$x < $y
> 	greater than, comparison ex) 	$x > $y
<= 	less than or equal to, comparison ex) 	$x <= $y
>= 	greater than or equal to, comparison ex) 	$x >= $y
! 	not 	logical ex) 	!$x
&&
AND 	and 	logical ex) 	$x && $y  ex) $x AND $y
||
OR 	or 	logical ex) 	ex) $x || $y  ex) $x OR $y
*/
?>
