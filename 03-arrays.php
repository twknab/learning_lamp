<?php
// Arrays are slightly different in PHP than in JS or Python.

// Newest versions of PHP support an empty array declaration such as:
$cool_stuff = [];

// However, this is the most common way to create an empty array:
$really_cool_stuff = array();

// Add some stuff to the array:
// Note: by not providing an index, the data automatically is populated as the last index. e.g, of array with last index of `n`, would populate as `n + 1`:
$cool_stuff[] = "Test string.";
$really_cool_stuff[] = "Another test string.";

// Print our array additions to screen:
echo "<p>" . $really_cool_stuff[0] . "</p>"; // note inclusion of <p> tags with "." as concatenator. 
echo "<p>" . $cool_stuff[0] . "</p>";

// We can also do key value pairs such as:
$my_ski_things = array(
  "feet" => "sock liners, warm socks and boots",
  "hands" => "mittens and glove liners",
  "face" => "face mask, neckwarmer, ski goggles",
  "upper_body" => "2 base layers, waterproof shell",
  "lower_body" => "base layer, snow pants",
);

// Try printing one to screen:
echo "<p>" . $my_ski_things["feet"] . "</p>";

// You can also make an array this way, similar to JS and Py:
$more_things = [
  "some" => "thing",
];

// Test it:
echo "<p>" . $more_things["some"] . "</p>";
?>

<!-- Notice how within our PHP document we can still be writing HTML...PHP is cool! -->
<style>
  p {
    margin: 0;
    padding: 0;
  }
</style>
