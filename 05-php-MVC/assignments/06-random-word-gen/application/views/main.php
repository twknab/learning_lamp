<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Random Word Generator</title>
  <style>
    body {
      font-family: arial;
    }
    h2 { 
      text-align: center; 
    }
    #word { 
      padding: 20px; 
      border: 1px solid silver; 
      width: 400px; 
      margin: 15px auto; 
      text-align: center; 
    }
    form {
      margin: 15px auto;
      width: 400px;
      padding: 20px;
    }
    input[type="submit"] {
      display: block;
      margin: 15px auto;
      text-align: center;
      padding: 15px;
      border-radius: 5px;
      border: 0px;
      background-color: lightblue;
      font-size: 15px;
      font-weight: bolder;
      border: 4px solid silver;
    }
    input[type="submit"]:hover {
      background-color: orangered;
      color: white;
    }
    input[type="submit"]:active {
      background-color: red;
      color: white;
    }
  </style>
</head>
<body>
  <h2>Random Word (Attempt #<?=$attempt_count?>)</h2>
  <div id="word">
    <h1><?=$random_word?></h1>  
  </div>
  <form action="/main/generate" method="POST">
    <input type="submit" value="Generate">
  </form>
</body>
</html>