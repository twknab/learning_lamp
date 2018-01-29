<?php
/*
In php, multi-line commenting and regular commenting is the same as in JavaScript.
*/

// You can comment this way too.

/* The really cool thing about PHP is it can be placed in-line amidst HTML, right out of the box. Any HTML tags along with PHP will be converted to HTML/CSS/JS in the browser. */

// Check out the HTML & PHP example below:

// define a variable in PHP
// (variables should be lower case, and $in_snake_case_only, starting with a $)
$intro = "Hello World!";
$fname = "Tim";

// Notice how everything contained here is within a PHP tag!
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>My first PHP Page</title>
</head>
<body>
  <pre>See server side source document for full content of this page</pre>
  <h1><?php echo $intro ?></h1>
  <p>My name is <?php echo $fname ?>. It's nice to meet you!</>

  <p>You can also concatenate strings using a period (".") within php, such as <strong><?php echo "water" . "melon"; ?></strong></p>

  <!-- Here's another snippet of PHP that we'll use for our next piece -->
  <?php
  $start = "pine";
  $end = "apple";
  ?>

  <p>You can also use double quotes (""), such as, <strong><?php echo "My favorite fruit is a: $start$end"; ?></strong></p>

  <?php
  // There are other data types than just strings, and note that using singular quotes ('' instead of "") will cause strings ot be literals and behave differently. Especially when integrating various data types.

  // One cool thing about PHP is we can actually add conflicting data types without having to first convert them... (which can get us into bad habits, but is convenient for the time being):

  // Define some variables:
  $number = 10;
  $string = "10";
  $float = 10.023;

  echo "We can sketchily add mixed data types...which albeit is convenient: " . ($number + $string + $float);
  // prints 30.023
  // also remember: "." is a concatenation operator

  // Other data types like:
  $am_i_here = true;
  $is_it_xmas = false;

  $literally = 'Like, this is a string literal.';
  ?>
</body>
</html>
