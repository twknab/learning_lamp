<?php

// Loops in PHP work similarly to other languages you're familiar with by now:

// FOR LOOP
// For loop in PHP:
for($i = 0; $i <= 10; $i++) {
  echo "<p>Hello world!</p>";
};
// Will print 10 repetitions of "Hello world" to screen
// Note that the setup is basically the same as JavaScript

// We can also use something called a "foreach" loop, which *only works for arrays*, but can loop through key value pairs:
$things = ["item1" => "coffee", "item2" => "desk", "item3" => "cat"];

// FOREACH LOOP
// Will loop through $things and print each value:
foreach($things as $thing) {
  echo "<p>$thing</p>";
};

// WHILE LOOP
// While loops are also similar to JS:
$i = 0; // initialize variable
while( $i < 10 )
{
  echo $i; // prints i
  $i++; // increases count by 1
};


// DO...WHILE LOOP
$j = 0;
do {
  // will do this stuff as long as while loop condition is met:
  echo $j;
  $j++;
} while ($j < 10); // while conditions are met will do loop
// Note: This seems somewhat unique to PHP for my learning thus far and is pretty cool.
?>
