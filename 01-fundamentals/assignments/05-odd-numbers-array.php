<?php
/*
Create an array that inclusively contains all odd numbers between 0 to 20,000. Use the var_dump() function at the end to display the array values.

var_dump($array_variable);
*/

// Hint, use: array_push(array, value1, value2,...)

$array = [];

for($i = 0; $i <= 20000; $i++){
  if ($i % 2 == 1){
    array_push($array, $i);
  }
}

echo var_dump($array);
?>
