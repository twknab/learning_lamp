<?php
// Generate a random number between 50-100:
$score = rand(50,100);
// Create a variable to hold a grade:
$grade = "";

// Show a message depending upon score:
if ($score < 70) {
  $grade = "D";
} elseif ($score >= 70 && $score <= 80) {
  $grade = "C";
} elseif ($score >= 80 && $score <= 90) {
  $grade = "B";
} elseif ($score >= 90 && $score <= 100) {
  $grade = "A";
};
?>

<!-- Display results in HTML on page -->
<h1><?php echo $score ?></h1>
<h2><?php echo $grade ?></h2>
