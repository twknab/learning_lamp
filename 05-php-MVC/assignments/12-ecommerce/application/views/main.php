<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LAMP E-Commerce Store</title>
  <style>
    body {
     font-family: arial, courier; 
    }
    /* input {
      display: block;
      margin: 0 0 10px 0;
      padding: 5px;
    } */
    tr {
      text-align: center;
    }
    table {
      padding: 15px;
      width: 100%;
      background-color: aliceblue;
    }
    tr form {
      display: inline;
    }
    .cart {
      text-align: right;
      padding: 10px;
    }
    .micro {
      font-size: 10px;
      color: blue;
    }
  </style>
</head>
<body>
  <h3 class="cart"><a href="/cart">Your Cart (<?=$order_count?>)</a></h3>
  <?php 
    if (isset($errors))
    {
      var_dump($errors);
    }
  ?>
  <fieldset>
    <legend><h1>Products</h1></legend>
    <table>
      <tr>
        <th>Description</th>
        <th>Price</th>
        <th>Quantity</th>
        <th></th>
      </tr>
      <?php foreach ($products as $product) { ?>
        <tr>
          <td><?=$product["description"]?></td>
          <td>$<?=number_format((float)$product["price"], 2, '.', ',')?></td>
          <td>
            <?php 
              $hidden = array('inventory' => $product["inventory"],'product_id' => $product["id"]);
              echo form_open('order/buy', '', $hidden); 
            ?>
            <input type="number" name="quantity" id="quantity" min="0" max="<?=$product["inventory"]?>">
            <p class="micro"><?=$product["inventory"]?> in stock.</p>
          </td>
          <td>
            <input type="submit" value="Buy">
            </form>
          </td>
        </tr>
       <?php } ?>
</table>
  </fieldset>
</body>
</html>