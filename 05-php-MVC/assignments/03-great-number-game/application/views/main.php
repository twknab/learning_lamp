<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CodeIgniter Great Number Game</title>
  <style>
   body {
     text-align: center;
   }
   form {
     padding: 15px;
     margin: 15px auto;
     width: 500px;
   }
   .result {
     padding: 15px;
     margin: 15px auto;
     width: 250px;
     font-size: 29px;
   }
   .wrong {
     color: orangered;
     border: 1px solid orange;
   }
   .correct {
     color: green;
     border: 1px solid lightgreen;
   }
   .error {
     color: orange;
     font-weight: 800;
     padding: 20px;
     border: 1px dotted orangered;
     width: 500px;
     margin: 15px auto;
   }
  </style>
</head>
<body>
  <h1>Welcome to The Great Number Game!</h1>
  <h3>I'm thinking of a number between 1 and 100...</h3>
  <h3>Take a guess!</h3>
  <!-- Answer Too High -->
  <?php if (isset($guess) && $guess > $number) { ?>
    <div class="result wrong">
      <h1>Too High!</h1>
    </div>
  <?php } ?>
  <!-- Answer Too Low  -->
  <?php if (isset($guess) && $guess < $number) { ?>
    <div class="result wrong">
      <h1>Too Low!</h1>
    </div>
  <?php } ?>
  <!-- If Correct  -->
  <?php if (isset($guess) && $guess === $number) { ?>
    <div class="result correct">
      <h1><?=$number?> was the number!</h1>
    </div>
    <form action="/main/reset">
      <input type="submit" value="Play again!">
    </form>
  <?php } ?>
  <?php if (!isset($guess) || $guess !== $number ) { 
    if (isset($error) && $error) {
  ?>
    <div class="error"><?=$error?></div>
  <?php
    }  
  ?>
    <form action="/main/guess" method="POST">
      <input type="number" name="guess" id="guess" required>
      <input type="submit" value="Guess!">
    </form>
  <?php } ?>
</body>
</html>