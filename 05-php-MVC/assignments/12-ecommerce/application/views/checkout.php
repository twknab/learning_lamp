<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Checkout</title>
  <style>
    body {
      font-family: arial, courier;
    }
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

    .home {
      text-align: right;
      padding: 10px;
    }
    .no_orders {
      text-align: center;
      font-style: italic;
      font-weight: lighter;
    }
    .total {
      text-align: center;
    }
  </style>
</head>

<body>
  <h3 class="home"><a href="/">Home</a></h3>
  <fieldset>
    <legend>
      <h1>Check Out</h1>
    </legend>
    <?php if (count($orders) < 1) { ?>
      <h2 class="no_orders">No orders yet! 🛒</h2>
    <?php } 
      else {
    ?>
    <table>
      <tr>
        <th>Quantity</th>
        <th>Description</th>
        <th>Price</th>
        <th></th>
      </tr>
      <?php foreach ($orders as $order) { ?>
      <tr>
          <td><?=$order['quantity']?></td>
          <td><?=$order['description']?></td>
          <td>$<?=number_format((float)$order["price"], 2, '.', ',')?></td>
          <td>
          <?php 
            $hidden = array(
              'quantity' => $order['quantity'], 
              'product_id' => $order['product_id'],
              'order_id' => $order["id"]
            );
            echo form_open('order/delete', '', $hidden); 
          ?>
              <input type="submit" value="Delete">
            </form>
          </td>
      </tr>
      <?php  } ?>
    </table>
    <?php  } ?>
  </fieldset>
  <fieldset>
    <legend><h1>Total:</h1></legend>
    <p class="total">Your total today before taxes is:</p>
    <h1 class="total">$<?=number_format((float)$sum, 2, '.', ',')?></h1>
  </fieldset>
  <fieldset>
    <legend>
      <h1>Billing Details & Order</h1>
    </legend>
    <?php 
      echo form_open('order/checkout'); 
    ?>
    <input type="text" name="name" id="name" placeholder="Name">
    <input type="text" name="address" id="address" placeholder="Address">
    <input type="text" name="card_number" id="card_number" placeholder="Card Number">
    <input type="submit" value="Order">
   </form>
  </fieldset>
</body>

</html>