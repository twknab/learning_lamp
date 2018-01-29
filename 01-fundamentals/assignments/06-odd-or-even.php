<?php

for ($i = 0; $i <= 2000; $i++){
  if ($i % 2 == 0){
    echo "<p>Number is $i. This is an even number.</p>";
  } elseif ($i % 2 == 1) {
    echo "<p>Number is $i. This is an odd number.</p>";
  } else {
    echo "<p>Number meets neither requirement.</p>";
  }
}


?>
