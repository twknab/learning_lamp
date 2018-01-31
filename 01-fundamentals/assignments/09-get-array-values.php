<?php
// Create print lists function which produces <li> items for each value in array:
function print_lists($array) {
  foreach ($array as $index => $value) {
    echo "<li>$value</li>";
  };
  return $array; // returns array
};
?>

<!-- Create a <ul> tag with a PHP tag inserted which will run the desired function -->
<ul>
  <!-- will run print_lists, using an array as an argument: -->
  <?php print_lists(array(2,3,"hello")); ?>
</ul>
