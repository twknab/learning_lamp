<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
  public function get_all_orders()
  {
    $query = "SELECT * FROM orders ORDER BY created_at DESC";
    return $this->db->query($query)->result_array();
  }
  public function new_order($post_data)
  {
    $query = "INSERT INTO orders (quantity, product_id, created_at, updated_at) VALUES (?, ?, ?, ?)";
    $values = array($post_data['quantity'], $post_data['product_id'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
    return $this->db->query($query, $values);
  }
}
