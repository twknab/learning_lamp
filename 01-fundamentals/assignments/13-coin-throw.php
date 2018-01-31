
<!--
You're going to create a program that simulates throwing a coin 5,000 times. Your program should display how many times the head/tail appears.

Sample output should be like the following:

  Starting the program

  Attempt #1: Throwing a coin... It's a head! ... Got 1 head(s) so far and 0 tail(s) so far

  Attempt #2: Throwing a coin... It's a head! ... Got 2 head(s) so far and 0 tail(s) so far

  Attempt #3: Throwing a coin... It's a tail! ... Got 2 head(s) so far and 1 tail(s) so far

  Attempt #4: Throwing a coin... It's a head! ... Got 3 head(s) so far and 1 tail(s) so far

  ........

  Attempt #5000: Throwing a coin... It's a head! ... Got 2412 head(s) so far and 2588 tail(s) so far

  Ending the program - thank you!
-->
<?php
// Create a function which tosses a coin 5,000 times and records results:
function coin_throw(){
  // Create counter for heads and tails:
  $total_heads = 0;
  $total_tails = 0;

  // Simulate 5,000 coin tosses by generating 5,000 random numbers between 0 and 1.
  // 0's become heads, and 1's become tails.

  // Let's use a while loop for fun:
  $i = 1;
  while ($i <= 5000) {
    echo "<p>Attempt #{$i}: Throwing a coin...";
    $toss = rand(0,1);
    if ($toss == 0){
      $total_heads += 1;
      echo "It's a head! ... Got {$total_heads} head(s) so far and {$total_tails} tail(s) so far</p>";
    } else {
      $total_tails += 1;
      echo "It's a tail! ... Got {$total_heads} head(s) so far and {$total_tails} tail(s) so far</p>";
    };
    $i++; // increase counter
  };
  echo "<p>Ending the program - thank you!</p>";
}
?>

<div>
  <?php coin_throw(); ?>
</div>
<h1>Scroll to see all results!</h1>

<style>
  div {
    overflow: scroll;
    height: 75%;
    background-color: lightgrey;
    border: 5px solid grey;
  }
</style>
