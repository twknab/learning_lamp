<?php

$config = array(
  'register' => array (
    array(
      'field' => 'first_name',
      'label' => 'First Name',
      'rules' => 'trim|required|min_length[2]',
    ),
    array(
      'field' => 'last_name',
      'label' => 'Last Name',
      'rules' => 'trim|required|min_length[2]',
    ),
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|min_length[5]|valid_email|is_unique[users.email]',
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'trim|required|min_length[5]|matches[password_confirm]',
    ),
    array(
      'field' => 'password_confirm',
      'label' => 'Password Confirmation',
      'rules' => 'trim|required|min_length[8]',
    ),
  ),
  'login' => array (
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|min_length[5]',
    ),
    array(
      'field' => 'password',
      'label' => 'Password',
      'rules' => 'trim|required|min_length[5]',
    ),
  ),
  'edit_user_info' => array (
    array(
      'field' => 'first_name',
      'label' => 'First Name',
      'rules' => 'trim|required|min_length[2]',
    ),
    array(
      'field' => 'last_name',
      'label' => 'Last Name',
      'rules' => 'trim|required|min_length[2]',
    ),
    array(
      'field' => 'email',
      'label' => 'Email',
      'rules' => 'trim|required|min_length[5]|valid_email|is_unique[users.email]',
    ),
  ),
);
