<?php
session_start(); // start session
// if gold not already found, initialize at 0 and create an activit log (note: see note in process.php about activity log being stored in session):
if (!isset($_SESSION["gold"])) {
  $_SESSION["gold"] = 0;
  $_SESSION["activity"] = "";
} else {
  echo strlen($_SESSION["activity"]);
  // This will help keep size of activity log on server down.
  // If log gets bigger than 2000 characters, run a regex, to grab the last paragraph tag, and replace it with everything above it.
  while (strlen($_SESSION["activity"]) > 2000) {
    $_SESSION["activity"] = preg_replace('~(.*)<p>.*?</p>~', '$1', $_SESSION["activity"]);
    // Note that `$1` is not a standard variable, we never defined it. Instead, it's used in regex to denote the string content before the match. In this example, when we match our last paragraph tag, we replace it with the content before it.
    // See: https://stackoverflow.com/questions/30928764/php-regex-to-remove-last-paragraph-and-contents
  }
  echo $_SESSION["activity"];
}
?>
<style>
  h1 {
    display: inline-block;
  }
  .place, .total {
    border: 4px solid #000;
  }
  .place {
    padding: 20px;
    width: 200px;
    text-align: center;
  }
  .total {
    margin: 0 0 20px 0;
    padding: 20px;
    display: inline-block;
    background-color: orange;
  }
  #farm { background-color: lightgreen; }
  #cave { background-color: grey; }
  #house { background-color: lightblue; }
  #casino { background-color: pink; }
  input[type="submit"] {
    display: block;
    padding: 5px;
    margin: 15px auto 5px auto;
  }
  .activity {
    overflow-y: scroll;
    height: 150px;
    border: 4px solid grey;
    padding: 0 20px 0 20px;
  }
</style>
<h1>Your Gold:</h1>
<div class="total"><?= $_SESSION["gold"] ?></div>
<!-- Farm -->
<form class="place" id="farm" action="process.php" method="post">
  <label>Farm (earns 10-20 golds)</label>
  <input type="hidden" name="building" value="farm">
  <input type="submit" value="Find Gold!">
</form>
<!-- Cave -->
<form class="place" id="cave" action="process.php" method="post">
  <label>Cave (earns 5-10 golds)</label>
  <input type="hidden" name="building" value="cave">
  <input type="submit" value="Find Gold!">
</form>
<!-- House -->
<form class="place" id="house" action="process.php" method="post">
  <label>House (earns 2-5 golds)</label>
  <input type="hidden" name="building" value="house">
  <input type="submit" value="Find Gold!">
</form>
<!-- Casino -->
<form class="place" id="casino" action="process.php" method="post">
  <label>Casino! (earns/takes 0-50 golds)</label>
  <input type="hidden" name="building" value="casino">
  <input type="submit" value="Find Gold!">
</form>
<h4>Activities:</h4>
<div class="activity">
  <?= $_SESSION["activity"] ?>
</div>
