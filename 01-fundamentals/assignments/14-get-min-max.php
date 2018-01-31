<!--
Create a function get_max_and_min() that takes an array of numbers and, then, returns both the minimum and the maximum number from the given array as an associative array. Do not use the PHP function max() or min() to get this to work. See if you can do this using arrays and for loops!

For example:

$sample = array( 135, 2.4, 2.67, 1.23, 332, 2, 1.02);
$output = get_max_and_min($sample);
var_dump($output);
//$output should be equal to array('max' => 332, 'min' => 1.02);
-->

<?php

// Create a function for min, max:
function min_max($array) {
  // Create an associative array to hold our min and max values:
  $solution = array(
    array("max" => $array[0]), // set max to our first value
    array("min" => $array[0]), // set min to our first value
  );

  foreach ($array as $index => $value) { // loop through our values
    if ($solution[0]["max"] < $value) { // if current max is less than value
      $solution[0]["max"] = $value; // set max to new value
    } elseif ($solution[1]["min"] > $value) { // if current min is greater than value
      $solution[1]["min"] = $value; // set min to new value
    }
  }

  return $solution; // return solution array
};

// Create an array:
$A = [1,2,3,4,5];
$B = [-1,-2,-3,-4,-5];

// Test our function:
var_dump(min_max($A));
var_dump(min_max($B));

?>
