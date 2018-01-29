<?php
// Create a program that prints the sum of all the values in the array "numbers". Your "numbers" array should contain the following values: 1, 2, 5, 10, 255, 3:

$numbers = array(1, 2, 5, 10, 255, 3);
$sum = 0;
foreach ($numbers as $number) {
  $sum += $number;
};

echo $sum;

?>
