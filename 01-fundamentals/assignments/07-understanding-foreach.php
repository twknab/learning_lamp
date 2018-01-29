<?php

// Let's say that $x = [1,3,5,7]

// 1. What would be the output of the following code? Try to guess the output of the code before running it!

$x = array(1,3,5,7);
foreach($x as $key => $value)
{
  echo $key . " - " . $value ."<br />";
}

// Will output:
/*
0 - 1
1 - 3
2 - 5
3 - 7
*/

// 2. What would be the output of the following code? Try to guess the output of the code before running it!

$x = array(1,3,5,7);
foreach($x as $value)
{
  echo $value ."<br />";
}

// Will output:
/*
1
3
5
7
*/

// Let's now say that $x = [ "hi" => "Dojo", "awesome" => "game" ]

// 3. What would be the output of the following code? Try to guess the output of the code before running it!

$x = array("hi" => "Dojo", "awesome" => "game");
foreach($x as $key => $value)
{
  echo $key . " - " . $value ."<br />";
}

// Will output:

/*
hi - Dojo
awesome - game
*/

// 4. What would be the output of the following code? Try to guess the output of the code before running it!

$x = array("hi" => "Dojo", "awesome" => "game");
foreach($x as $key => $value)
{
  echo $value ."<br />";
}

// Will output:

/*
Dojo
game
*/

// 5. What would be the output of the following code? Try to guess the output of the code before running it!

$x = array("hi" => "Dojo", "awesome" => "game");
foreach($x as $key => $value)
{
  echo $key ."<br />";
}

// Will output:
/*
hi
awesome
*/

// 6. Okay. Now let's make it a little bit harder. What would be the output of the following code?

$x = array( array(1,3,5), array(2,4,6), array(3,6,9) );
foreach($x as $key => $value)
{
  echo "Key is {$key}<br />";
  echo "var_dumping value";
  var_dump($value);
}

// Will output:
/*
Key is 0
var_dumping value
array (size=3)
  0 => int 1
  1 => int 3
  2 => int 5
Key is 1
var_dumping value
array (size=3)
  0 => int 2
  1 => int 4
  2 => int 6
...
*/

// 7. Now what about this? Again guess the output before running the code.

$x = array( array(1,3,5), array(2,4,6), array(3,6,9) );
foreach($x as $value)
{
  echo "var_dumping value";
  var_dump($value);
}

// Will output:
/*
var_dumping value
array (size=3)
  0 => int 1
  1 => int 3
  2 => int 5
var_dumping value
array (size=3)
  0 => int 2
  1 => int 4
  2 => int 6
var_dumping value
array (size=3)
  0 => int 3
  1 => int 6
  2 => int 9
*/

// 8. Okay. Now let's make it even harder. What would be the output of the following code?

$x = array( array("hi"=>"Dojo", "game"=>"awesome"), array("dude"=>"fun", "play"=>"what?"), array("no"=>"way", "i am"=>"confused?") );
foreach($x as $key => $value)
{
  echo "key is {$key}<br />";
  foreach($value as $key2=>$value2)
  {
    echo $key2 ." - " . $value2."<br />";
  }
}

// Will output:
/*
key is 0
hi - Dojo
game - awesome
key is 1
dude - fun
play - what
key is 2
no - way
i am - confused?
*/

// 9. Now what about this?

$x = array( array("hi"=>"Dojo", "game"=>"awesome"), array("dude"=>"fun", "play"=>"what?"), array("no"=>"way", "i am"=>"confused?") );
foreach($x as $y)
{
  foreach($y as $key=>$value)
  {
    echo $key ." - " . $value."<br />";
  }
}

// Will output:
/*
hi - Dojo
game - awesome
dude - fun
play - what
no - way
i am - confused?
*/

?>
