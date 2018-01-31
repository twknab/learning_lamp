<?php

// PART ONE:
// Take an array of numbers:
$A = array(2,4,10,16);

// Write a function which will multiply each value by 5:
function multiply($arr) {
  // Note: Will use a foreach loop to use PHP-esque techniques (see note below):
  foreach ($arr as $index => $value) { // Loop through array
    $arr[$index] = ($value * 5); // replace each array value with value*5
  }
  return $arr; // return array
}

// Test our new function
var_dump(multiply($A)); // [10,20,50,80]

// Note, you could of course also write this function in a javascript formatted way such as:
function multiplay_like_javascript($arr){
  // This for loop is valid but more how you might approach it in JS:
  for ($i = 0; $i < count($arr); $i++){
    $arr[$i] = ($arr[$i] * 5);
  }
  return $arr;
}

// Test our other function:
var_dump(multiply($A));

// PART TWO:
// Take an array and multiply it by N:

// An array of numbers:
$B = array(2,4,10,16);

// Write a function which will multiply each value by N:
function multiply_by_n($arr, $n) {
  foreach ($arr as $index => $value) {
    $arr[$index] = ($value * $n);
  };
  return $arr;
};

// Test function:
var_dump(multiply_by_n($B, 2));

?>
