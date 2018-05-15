<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard</title>
  <style>
    body {
     font-family: arial, courier;
    }
  </style>
</head>
<body>
  <fieldset>
    <legend><h1>Welcome <?= $user['first_name'] ?>!</h1></legend>
    <ul>
      <li>First Name: <?= $user['first_name'] ?></li>
      <li>Last Name: <?= $user['last_name'] ?></li>
      <li>Email: <?= $user['email'] ?></li>
    </ul>
    <a href="user/logoff">Log Off</a>
  </fieldset>
</body>
</html>