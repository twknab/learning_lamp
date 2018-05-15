<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
  public function demo_products()
  {
    $results = array(); // Will hold TRUE/FALSE values if insert is successful/unsucc
    $query = "INSERT INTO products (description, price, inventory, created_at, updated_at) VALUES (?,?,?,?,?)";
    $values = array( // Will hold demo products
      array('T-Shirt', 12.99, 16, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')),
      array('Desk Mount', 49.99, 15, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')),
      array('Fruit Bowl', 29.99, 4, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')),
      array('Organizer', 9.99, 2, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')),
      array('DooHickee', 3900.99, 3000, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')),
    );
    // Loop through products and insert:
    foreach ($values as $key) {
      $val = array($key[0], $key[1], $key[2], $key[3], $key[4]);
      $results[] = $this->db->query($query, $val);
    }
    return $results;
  }
  public function get_all_products()
  {
    $query = "SELECT * FROM products ORDER BY created_at DESC";
    return $this->db->query($query)->result_array();
  }
  public function reduce_inventory($quantity, $new_inventory, $product_id)
  {
    // Validate inventory change and quantity:
    $this->load->library('form_validation');
    $this->form_validation->set_message('less_than', 'Quantity must be at least 1 and cannot exceed inventory.');
    if ($this->form_validation->run('buy') === FALSE)
    {
      // Ship back errors and false:
      return array(FALSE, validation_errors());
    }
    else 
    {
      $query = "UPDATE products SET inventory = ? WHERE id = ?";
      $values = array($new_inventory, $product_id);
      return $this->db->query($query, $values);
    }
  }
}
