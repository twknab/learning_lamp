<!--
Part 1

Create a function called draw_stars() that takes an array of numbers and echo out  an asterisk, or '*'.

For example:

$x = array(4, 6, 1, 3, 5, 7, 25);

draw_stars(x) should print the following on the screen or browser:

****
******
*
***
*****
*******
*************************
-->

<?php

// Function which takes an array and prints a line
function draw_stars($array) {
  echo "Drawing starts now...";
  foreach ($array as $index => $value) {
    echo "<p>" . str_repeat("*", $value) . "</p>";
  };
  echo "<hr>";
};

// Note: that the str_repeat() method takes a string and a multiplier.
// Pythoneque ways, e.g,  ("*" * $value) will cause an error.
// Must use a built-in string function.


// Test our function:
draw_stars([4, 6, 1, 3, 5, 7, 25]);
?>

<!--
Part 2

Modify the function above. Allow an array, that contains integers and strings, to be passed to the draw_stars() function. When a string is passed, instead of displaying *, display the first letter of the string according to the example below.

For example:

 $x = array(4, "Tom", 1, "Michael", 5, 7, "Jimmy Smith");

draw_stars($x) should print the following on the screen/browser:

****
ttt
*
mmmmmmm
*****
*******
jjjjjjjjjjj
-->

<?php

// Hint: use lcfirst() function (lowercase first letter):

function draw_stars_again($array) {
  echo "Drawing now....";
  // Loop through array:
  foreach ($array as $index => $value) {
    if ((is_numeric($value)) == 1) {
      echo "<p>" . str_repeat("*", $value) . "</p>";
    } elseif ((is_string($value)) == 1) {
      echo "<p>" . str_repeat(lcfirst($value)[0], strlen($value)) . "</p>";
    } else {
      echo "<p>Invalid data type.</p>";
    }
  };
  echo "<hr>";
};

// Test string:
draw_stars_again([4, "Tom", 1, "Michael", 5, 7, "Jimmy Smith"]);

/*
Notes:
We use some new built in functions in this assignment.

- The first built in function we use is "str_repeat(string, multiplier)" -- this will return the string repeated to the multiplier number.

- Another built in method we use is "is_numeric(data)" and "is_string(data)", each of which return a `1` if the data provided is numeric or a string, respectively.

- We will also use `lcfirst(string)`. which takes a string and converts the first letter to lower case.

- `strlen(string)` will provide the length of a string, including any white spaecs or characters.
*/
?>
