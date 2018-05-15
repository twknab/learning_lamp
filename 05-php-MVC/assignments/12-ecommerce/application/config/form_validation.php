<?php

$config = array(
  'buy' => array (
    array(
      'field' => 'new_inventory',
      'label' => 'Inventory',
      'rules' => 'greater_than[0]',
    ),
    array(
      'field' => 'quantity',
      'label' => 'Quantity',
      'rules' => 'greater_than[1]',
    ),
  ),
);
