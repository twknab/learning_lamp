<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ninja Gold</title>
  <style>
    body {
      margin: 50px;
      font-family: arial;
      background-color: grey;
    }
    body div, body span {
      border-radius: 15px;
    }
    #gold {
      padding: 20px;
      border: 5px solid gold;
      color: orangered;
      background-color: moccasin;
    }
    #places {
      display: grid;
      grid-template-columns: auto auto auto auto;
    }
    .place {
      padding: 50px;
      margin: 30px 10px;
      text-align: center;
      border: 5px solid gold;
    }
    .place:nth-child(1) {
      background-color: plum;
    }
    .place:nth-child(2) {
      background-color: paleturquoise;
    }
    .place:nth-child(3) {
      background-color: mistyrose;
    }
    .place:nth-child(4) {
      background-color: lightcoral;
    }
    #activity {
      overflow-y: scroll;
      width: 100%;
      height: 100px;
      border: 5px solid gold;
      background-color: moccasin;
      padding: 10px;
    }
    input[type="submit"] {
      padding: 10px;
    }
    #title {
      color: gold;
      margin: 50px 0px;
      text-align: center;
      font-size: 60px;
      text-shadow: 1px 1px darkgrey;
    }
  </style>
</head>
<body>
  <h1 id="title">Welcome to Ninja Gold!</h1>
  <div>
    <p><strong>Your Gold: <span id="gold"><?=$gold?></span></strong></p>
  </div>
  <div id="places">
    <!-- Farm  -->
    <div class="place">
      <h1>Farm</h1>
      <p>(earns 10-20 gold)</p>
      <form action="/process_money" method="POST">
        <input type="hidden" name="building" value="farm">
        <input type="submit" value="Find Gold!">
      </form>
    </div>
    <!-- Cave  -->
    <div class="place">
      <h1>Cave</h1>
      <p>(earns 5-10 gold)</p>
      <form action="/process_money" method="POST">
        <input type="hidden" name="building" value="cave">
        <input type="submit" value="Find Gold!">
      </form>
    </div>
    <!-- House  -->
    <div class="place">
      <h1>House</h1>
      <p>(earns 2-5 gold)</p>
      <form action="/process_money" method="POST">
        <input type="hidden" name="building" value="house">
        <input type="submit" value="Find Gold!">
      </form>
    </div>
    <!-- Casino  -->
    <div class="place">
      <h1>Casino</h1>
      <p>(earns 0-50 gold)</p>
      <form action="/process_money" method="POST">
        <input type="hidden" name="building" value="casino">
        <input type="submit" value="Find Gold!">
      </form>
    </div>
  </div>
  <div>
  <h3>Activities:</h3>
    <div id="activity"><?=$activity?></div>
  </div>
</body>
</html>