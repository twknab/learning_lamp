<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CodeIgniter Counter</title>
  <style>
   body {
     text-align: center;
   }
   .board {
     padding: 15px;
     border: 1px solid silver;
     margin: 15px auto;
     width: 120px;
     font-size: 72px;
     color: orangered;
     font-weight: bolder;
   }
  </style>
</head>
<body>
  <h1>You've visited</h1>
  <div class="board">
   <?=$count?>
  </div>
  <h2>Times</h2>
  <form action="/main/reset">
   <input type="submit" value="Reset">
  </form>
</body>
</html>