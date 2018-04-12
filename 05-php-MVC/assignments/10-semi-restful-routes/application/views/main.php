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
    tr {
      text-align: center;
    }
    table {
      padding: 10px;
      background-color: aliceblue;
    }
    tr form {
      display: inline;
    }
  </style>
</head>
<body>
  <fieldset>
    <legend><h1>Products</h1></legend>
    <table style="width:100%">
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
      </tr>
      <?php 

        if (isset($products))
        {
          foreach ($products as $product) 
          {
      ?> 
      <tr>
        <td><?=$product["name"]?></td>
        <td><?=$product["description"]?></td>
        <td>$<?=$product["price"]?></td>
        <td><a href="products/show/<?=$product["id"]?>">Show</a> | <a href="products/edit/<?=$product["id"]?>">Edit</a> | <form action="products/destroy/<?=$product["id"]?>" method="POST"><input type="submit" value="Remove"></form></td>
      </tr>
      <?php 
        }
       }  
      ?>
    </table> 
  </fieldset>
  <fieldset>
    <legend><h1>Add Product</h1></legend>
    <a href="products/new">Add a new product</a>
  </fieldset>
</body>
</html>