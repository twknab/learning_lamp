<?php

// Functions look and feel a lot like they do in JS. Here's a function in PHP:

function my_first_php_function(){
  echo "Hello world!";
  return "Goodbye!"; // return statement syntax same as JS
};

// And with a parameter, be sure to use the $ sign as well (sigil):
function my_second_function($something){
  echo $something;
  return "Done!";
};

// We can of course use functions to rec'v input and iterate through things, such as arrays. Let's take the following array and then write a function to iterate through it:

$my_outdoor_stuff = array(
  array(
    "kitchen" => "stove, fuel, pot, spatula, fork, soap",
    "hygiene" => "hand sanitizer, toothpaste, toothbrush, floss, nail clipper",
    "sleeping" => "sleeping pad, sleeping bag, inflatable pillow",
    "warmth" => "long underwear, hat, gloves, winter jacket",
    "legs" => "hiking pants",
    "feet" => "hiking boots",
    "waterproof" => "rain jacket, rain pants",
    "safety" => "first aid, repair kit",
  ),
  array(
    "gear" => "backpack, hiking poles, water jugs, water filtration",
    "shelter" => "tent, stakes, rainfly",
  ),
  array(
    "navigation" => "map, compass, GPS",
    "emergency" => "VHF radio, bivvy"
  )
);

// Note: This function contains nested foreach loops, and doesn't return anything.
function show_my_outdoor_stuff($array) {
  foreach ($array as $category) {
    var_dump($category); // spits out each array
    foreach ($category as $value => $item) { // goes through each item in array
      echo "<p><strong>$value</strong> - $item</p>"; // prints category and item
    }
  };
  return NULL;
};

// Test my function:
show_my_outdoor_stuff($my_outdoor_stuff)
// Will print to screen each sub-array, and then iterate through each array printing each item.

?>
