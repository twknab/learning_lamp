<?php

$config = array(
  'create' => array (
    array(
      'field' => 'name',
      'label' => 'product name',
      'rules' => 'trim|required|min_length[5]',
    ),
    array(
      'field' => 'description',
      'label' => 'product description',
      'rules' => 'trim|required|min_length[5]',
    ),
    array(
      'field' => 'price',
      'label' => 'product price',
      'rules' => 'trim|required|min_length[1]|less_than[100000]|decimal',
    ),
  ),
);
