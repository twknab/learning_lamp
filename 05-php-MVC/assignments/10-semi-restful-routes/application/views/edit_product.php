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
  <?php
if (isset($product)) {
  ?>
  <fieldset>
    <legend><h1>Edit Product <?=$product["id"]?></h1></legend>
    <?php
      if (isset($errors)) {
    ?>
      <div class="err"><?=$errors?></div>
    <?php
      }
    ?>
    <form action="../update/<?=$product["id"]?>" method="POST">
      <input type="hidden" name="product_id" value="<?=$product["id"]?>">
      <p><label for="name">Name</label>
        <input type="text" name="name" id="name" value="<?=$product["name"]?>">
      </p>
      <p><label for="description">Description</label>
        <input type="text" name="description" id="description" value="<?=$product["description"]?>">
      </p>
      <p><label for="price">Price $</label>
        <input type="number" name="price" id="price" step=".01" value="<?=$product["price"]?>">
      </p>
      <input type="submit" value="Update">
    </form>
  </fieldset>
  <a href="/products/show/<?=$product["id"]?>">Show</a> | <a href="/products">Back</a>
  <?php
}
?>
</body>
</html>