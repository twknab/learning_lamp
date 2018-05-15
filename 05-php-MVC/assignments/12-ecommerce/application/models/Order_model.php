<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
  public function get_all_orders()
  {
    $query = "SELECT * FROM orders ORDER BY created_at DESC";
    return $this->db->query($query)->result_array();
  }
  public function get_all_orders_and_products()
  {
    $query = "SELECT orders.id, orders.quantity, orders.created_at, orders.updated_at, products.id AS product_id, products.description, products.price FROM orders LEFT JOIN products ON orders.product_id = products.id;";
    return $this->db->query($query)->result_array();
  }
  public function new_order($post_data)
  {
    $query = "INSERT INTO orders (quantity, product_id, created_at, updated_at) VALUES (?, ?, ?, ?)";
    $values = array($post_data['quantity'], $post_data['product_id'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
    return $this->db->query($query, $values);
  }
  public function delete_order($post_data)
  {
    $this->load->model('Product_model');
    // Increase product inventory #quantity:
    $result = $this->Product_model->increase_inventory($post_data["product_id"], $post_data["quantity"]);

    if ($result === FALSE)
    {
      return FALSE;
    }
    // Delete order:
    $query = "DELETE FROM orders WHERE id = ?";
    $values = array($post_data['order_id']);
    return $this->db->query($query, $values);
  }
}
