<?php

$config = array(
  'buy' => array (
    array(
      'field' => 'new_inventory',
      'label' => 'Inventory',
      'rules' => 'trim|less_than[0]',
    ),
    array(
      'field' => 'quantity',
      'label' => 'Quantity',
      'rules' => 'trim|less_than[1]',
    ),
  ),
);
