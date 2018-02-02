<!--
Write a program that generates an HTML page that looks like a checkerboard using divs. If you're having trouble, think back to the multiplication table you wrote earlier in the chapter!
-->
<style>
  .fill, .empty {
    padding: 30px;
    display: inline-block;
  }
  .checkerboard_wrapper {
    display: inline-block;
  }
</style>

<!--
First we create the function, then we'll invoke it below (we can then draw many boards if we want.

Note: This is not likely the most efficient way to do this...however I did add parameters for the fill, empty and border colors. These must be either an accepted HTML5 color word (e.g, whitesmoke, white, grey, red, etc) or a hex number with the # included.
-->
<?php
// Draw checkerboard:
function draw_checkerboard($height, $width, $fill, $empty, $border){
  /*
  Draws a checkboard of a given dimension, and accepts colors as arguments.

  Parameters:
  - `height` - desired height of checkerboard.
  - `width` - desired width of checkerboard.
  - `fill` - desired fill color as HTML5 color or hex including hash (e.g., #000).
  - `empty` - desired empty color as HTML5 color or hex including hash (e.g., #fff).
  - `border` - desired border color as HTML5 color or hex including hash (e.g., #000).
  */
  echo "<div class='checkerboard_wrapper' style='border: 4px solid $border;'>";
  for ($h = 1; $h <= $height; $h++) {
    echo "<div>";
    for ($i = 1; $i <= $width; $i++) {
      if ($h % 2 == 1) {
        if ($i % 2 == 0) {
          echo "<div class='fill' style='background-color: $fill;'></div>";
        } else {
          echo "<div class='empty' style='background-color: $empty;'></div>";
        }
      } else {
        if ($i % 2 == 0) {
          echo "<div class='empty' style='background-color: $empty;'></div>";
        } else {
          echo "<div class='fill' style='background-color: $fill;'></div>";
        }
      }
    };
    echo "</div>";
  }
  echo "</div>";
}
?>

<!-- Test our function by drawing 9 unique checkerboards -->
<?php
  draw_checkerboard(8, 8, "green", "tan", "green");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "black", "white", "black");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "darkblue", "grey", "darkblue");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "darkgrey", "whitesmoke", "darkgrey");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "darkred", "lightred", "darkred");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "red", "pink", "red");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "orange", "yellow", "orange");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "darkorange", "lightblue", "darkorange");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(8, 8, "#000", "#1a1a", "#000");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(2, 2, "purple", "lightgreen", "purple");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(3, 3, "#dddaaa", "#1a1a", "#dddaaa");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(4, 4, "lightblue", "yellow", "lightblue");
  echo "&nbsp;"; // insert a space
  draw_checkerboard(5, 5, "brown", "lightbrown", "brown");
?>
