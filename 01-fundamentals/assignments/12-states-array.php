<!--
Assignment: You have an array, called $states, which has the following information:

$states = array('CA', 'WA', 'VA', 'UT', 'AZ');
copy

Display a drop-down menu in HTML (using select tag and option tag) that displays the different states. Create this drop-down menu using for loops. Create another identical drop-down menu but, this time, use foreach statement.

Once you're done with the above exercise, insert three new states in the array $states: 'NJ', 'NY', 'DE'. Display a new drop-down menu with the eight unique states.

Your output should have three drop-down menus.
-->

<?php
// Create an array:
$my_states = array("CA", "WA", "VA", "UT", "AZ");

// Create a function which will print states:
function get_states($states) {
  for ($i = 0; $i < count($states); $i++) {
    echo "<option>$states[$i]</option>";
  };
};
?>

<!-- Get all states and print them into a <select> object: -->
<h1>States (Part 1)</h1>
<select>
  <?php get_states($my_states); ?>
</select>

<?php
// Add a few states to $my_states:
array_push($my_states, "NJ", "NY", "DE");
?>

<!-- Get all states again to test if new states have been added: -->
<h1>States (Part 2)</h1>
<h5><em>New states added</em></h5>
<select>
  <?php get_states($my_states); ?>
</select>
