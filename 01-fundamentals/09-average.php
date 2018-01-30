<?php

// Create an array of numbers:
$my_numbers = [1,2,3,4,5,6,7,8,9,10];

// Create a function to determine average:
function print_average($array) {
  $sum = 0;
  foreach ($array as $integer) {
    $sum += $integer;
  }
  return ($sum/count($array));
};

echo print_average($my_numbers);
// => 5.5

?>
