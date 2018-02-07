<?php session_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Great Number Game</title>
  </head>
  <body>
    <h1>Welcome to the Great Number Game</h1>
    <h2>I am thinking of a number between 1 and 100!</h2>
    <h3><strong>Take a guess!</strong></h3>
    <!-- Guess Response -->
    <?php
      // If session number assigned and guess submitted:
      if (isset($_SESSION['number']) && isset($_SESSION['guess']) && $_SESSION) {
        // If guess matches number:
        if ($_SESSION['number'] == $_SESSION['guess']) {
          echo "<div style='background-color: green;'>";
          echo "<h1> {$_SESSION['number']} was the number!</h1>";
          echo "<form action='process.php' method='POST'>";
          echo "<input type='hidden' name='action' value='reset'>";
          echo "<input type='submit' value='Play Again!'>";
          echo "</form>";
          echo "</div>";
        } elseif ($_SESSION['number'] > $_SESSION['guess']) { // if guess low
          echo "<div style='background-color: red;'>";
          echo "<h1> Too low!</h1>";
          echo "</div>";
        } elseif ($_SESSION['number'] < $_SESSION['guess']) { // if guess high
          echo "<div style='background-color: red;'>";
          echo "<h1> Too high!</h1>";
          echo "</div>";
        }
      }
    ?>
    <!-- Guess Form -->
    <form action="process.php" method="post">
      <input type="hidden" name="action" value="guess">
      <input type="number" name="guess" placeholder="Choose a number">
      <input type="submit" value="Guess!">
    </form>
  </body>
</html>
