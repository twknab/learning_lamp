<?php
session_start(); // initialize session
date_default_timezone_set("America/Los_Angeles"); // set timezone for this project
// Note: this is going to show every user's timestamps as PST, but for learning purposes let's keep it simple for now.


// Another Note: about keeping Activity Log in session: Keeping all activity in session is not best decision as this can eat up server resoureces big time. But for simplicity and sake of focusing on the principles of this assignment, we're going to omit this very important aspect and carry on.

// If farm form is submitted:
if (isset($_POST["building"]) && $_POST["building"] == "farm") {
  // Generate random number between (10 - 20 gold and add to session['gold']):
  $gold_earned = rand(10,20);
  $_SESSION["gold"] += $gold_earned;
  $time = time(); // get current time
  $_SESSION["activity"] = "<p>You entered a farm and got ${gold_earned} gold.... " . date("F jS o g:i a", $time) . "</p>" . $_SESSION["activity"];

  header("Location: index.php");
  die(); // kill process.php
}

// If cave form is submitted:
else if (isset($_POST["building"]) && $_POST["building"] == "cave") {
  // Generate random number between (5 - 10 gold and add to session['gold']):
  $gold_earned = rand(5,10);
  $_SESSION["gold"] += $gold_earned;
  $time = time(); // get current time
  $_SESSION["activity"] = "<p>You entered a cave and got ${gold_earned} gold.... " . date("F jS o g:i a", $time) . "</p>" . $_SESSION["activity"];

  header("Location: index.php");
  die(); // kill process.php
}

// If house form is submitted:
else if (isset($_POST["building"]) && $_POST["building"] == "house") {
  // Generate random number between (2 - 5 gold and add to session['gold']):
  $gold_earned = rand(2,5);
  $_SESSION["gold"] += $gold_earned;
  $time = time(); // get current time
  $_SESSION["activity"] = "<p>You entered a house and got ${gold_earned} gold.... " . date("F jS o g:i a", $time) . "</p>" . $_SESSION["activity"];
  header("Location: index.php");
  die(); // kill process.php
}

// If casino form is submitted:
else if (isset($_POST["building"]) && $_POST["building"] == "casino") {
  // Generate a random number between 1 and 100:
  // Note: this is maybe not exactly 50:50 odds (research):
  $coin_toss = rand(1,100);
  if ($coin_toss <= 50) { // if 1-50
    // Generate random number between (0 - 50 gold and add to session['gold']):
    $gold_earned = rand(0,50);
    $_SESSION["gold"] += $gold_earned;
    $time = time(); // get current time
    $_SESSION["activity"] = "<p>You entered a casino and got ${gold_earned} gold.... " . date("F jS o g:i a", $time) . "</p>" . $_SESSION["activity"];
    header("Location: index.php");
    die(); // kill process.php
  } else if ($coin_toss >= 51) { // if 51-100
    // Generate random number between (0 - 50 gold and *subtract from session['gold']):
    $gold_lost = rand(0,50);
    $_SESSION["gold"] -= $gold_lost;
    $time = time(); // get current time
    $_SESSION["activity"] = "<p style='color: red;'>You entered a casino and lost ${gold_lost} gold...ouch " . date("F jS o g:i a", $time) . "</p>" . $_SESSION["activity"];
    header("Location: index.php");
    die(); // kill process.php
  }
}


?>
