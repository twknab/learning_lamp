<?php
// Create a program that prints all the multiples of 5 starting at 5 and going up to 1,000,000.

for($i = 0; $i <= 1000000; $i++){
  if ($i % 5 == 0 && $i != 0) {
    echo "<p>$i</p>";
  }
}
?>
