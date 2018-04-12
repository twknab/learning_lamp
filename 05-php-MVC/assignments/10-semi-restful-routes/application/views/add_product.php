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
    .err {
      border: 2px solid silver;
      background-color: bisque;
      padding: 10px;
      width: 300px;
    }
  </style>
</head>
<body>
  <fieldset>
    <legend><h1>Add New Product</h1></legend>
    <?php 
      if (isset($errors)) 
      {
    ?>
      <div class="err"><?=$errors?></div>
    <?php
      }
    ?>
    <form action="./create" method="POST">
      <p><label for="name">Name:</label>
        <input type="text" name="name" id="name">
      </p>
      <p><label for="description">Description:</label></p>
      <textarea name="description" id="description" cols="30" rows="10"></textarea>
      <p><label for="price">Price:</label>
        <input type="number" name="price" id="price" step=".01">
      </p>
      <input type="submit" value="Create">
    </form>
  </fieldset>
  <a href="/products">Go back</a>
</body>
</html>