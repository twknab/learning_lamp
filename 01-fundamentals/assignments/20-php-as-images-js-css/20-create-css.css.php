<?php
// Defines that this is a CSS document for the php interpreter:
header('Content-type: text/css');

// Add some background colors as an array:
$bg_colors = array("lightgrey", "whitesmoke", "cyan", "yellow", "orange", "pink", "lightblue");

// Add some random h2 tag colors as an array:
$h1_colors = array("darkgreen", "darkblue", "black");

// Add some random h2 tag colors as an array:
$h2_colors = array("black", "purple", "magenta", "brown");

?>

body {
  background-color: <?php echo $bg_colors[rand(0,6)]; ?>;
}

h1 {
  color: <?php echo $h1_colors[rand(0,2)]; ?>;
}

h2 {
  color: <?php echo $h2_colors[rand(0,3)]; ?>;
}
