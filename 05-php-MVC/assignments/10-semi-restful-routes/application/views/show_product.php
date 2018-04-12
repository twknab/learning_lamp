<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LAMP Products</title>
  <style>
    body {
     font-family: arial, courier; 
    }
  </style>
</head>
<body>
  <fieldset>
    <?php 
      if (isset($product)) 
      {
    ?>
    <legend><h1>Product <?=$product["id"]?></h1></legend>
    <ul>
      <li>Name: <?=$product["name"]?></li>
      <li>Description: <?=$product["description"]?></li>
      <li>Price: $<?=$product["price"]?></li>
    </ul>
    <a href="/products/edit/<?=$product["id"]?>">Edit</a> | <a href="/products">Back</a>
    <?php
      }
    ?>
</body>
</html>