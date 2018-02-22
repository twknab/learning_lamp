<?php

  $my_variable = "This is my string";
  $my_number = 12;
  $my_array = ["Strings", 1, 2, 3, 2, 3];
  $my_second_number = "13";
  $hungry = TRUE;
  $have_coffee = FALSE;

  $my_empty_array = array();
  $my_empty_array[] = "This is going to be the first thing";
  $my_empty_array[] = "This is going to be the second thing";

  // Instead of console.log:
  echo $my_variable;

  // What if I want to "echo" an array?
  var_dump($my_array); // spit out your arry values as an object
  // This is like console log but for arrays and objects.
  // If we try and echo $my_array we would get an error
  // Not going to look like [1, 2, 3] - will have extra info
  // More for your eyes for development, not likely to use it in your app

  var_dump($my_empty_array);

  $html_str = "";
  $html_str .= "<div>";
  $html_str .= "<p>Hello</p>";
  $html_str .= "</div>";

  echo $html_str;


  $counter = 0;
  while ($counter < 50) {
    echo "Hello";
    $counter++
  }


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style>
    body {
      background-color: lightgreen;
    }
    </style>
  </head>
  <body>

    <h1>My First PHP Page</h1>
    <p>Testing one two three</p>
    <p><?php echo $my_variable; ?></p>
      <?php
        for ($i = 0; $i < count($my_array); $i++) {
          echo "<p>" . $my_array[$i] . "</p>";
        };
      ?>
  </body>
</html>
