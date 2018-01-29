<?php
// Create a program that prints the average of the values in the array called "numbers". Array "numbers" should have the following values: 1, 2, 5, 10, 255, 3.

$numbers = [1,2,5,10,255,3];
$sum = 0;

foreach ($numbers as $number){
  $sum += $number;
}

echo ($sum / count($numbers));

?>
