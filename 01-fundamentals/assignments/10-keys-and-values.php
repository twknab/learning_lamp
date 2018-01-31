<?php
// Create a function which iterates through an array and spits out a dialogue such as:
/*
There are 2 keys in this array:
     first_name
     last_name
The value in the key 'first_name' is 'Michael'.
The value in the key 'last_name' is 'Choi'.
*/

// Loops through array and prints to screen as desired:
function keys_and_values($array) {
  // Writes out how many keys are in the array:
  echo "There are " . count($array) . " keys in this array:";
  // Loop through array and write out index name:
  foreach ($array as $index => $value) {
    echo "<blockquote>$index</blockquote>";
  };
  // Loop through array and write out index-value:
  foreach ($array as $index => $value) {
    echo "<p>The value in the key '$index' is '$value'.</p>";
  };
};

// Create an array for testing:
$A = array(
  "first_name" => "Michael",
  "last_name" => "Choi",
);

// Test our function:
keys_and_values($A);

?>
