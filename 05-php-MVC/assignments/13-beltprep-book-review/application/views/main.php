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
    tr {
      text-align: center;
    }
    td {
      padding: 10px;
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
    .errors {
      /* padding: 15px; */
      color: #C00;
    }
  </style>
</head>
<body>
  <h3 class="cart"><a href="/cart">Your Cart (<?=$order_count?>)</a></h3>
  <?php 
    if (isset($errors))
    {
  ?>
  <fieldset class="errors">
    <legend>Alert!</legend>
    <p><?=$errors?></p>
  </fieldset>
  <?php
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
            <input type="number" name="quantity" id="quantity" min="0" max="<?=$product["inventory"]?>" <?php 
              if ($product["inventory"] == 0)
              { ?> 
                disabled
            <?php  } 
            ?>>
            <span class="micro"><?=$product["inventory"]?> in stock.</span>
          </td>
          <td>
            <input type="submit" value="Buy" <?php 
              if ($product["inventory"] == 0)
              { ?> 
                disabled
            <?php  } 
            ?>>
            </form>
          </td>
        </tr>
       <?php } ?>
</table>
  </fieldset>
</body>
</html>