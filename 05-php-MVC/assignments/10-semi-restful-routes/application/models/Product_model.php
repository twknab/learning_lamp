<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
  public function get_all_products()
  {
    return $this->db->query("SELECT * FROM products ORDER BY created_at DESC")->result_array();
  }
  public function get_product($product_id)
  {
    return $this->db->query("SELECT * FROM products WHERE id = ?", array($product_id))->row_array();
  }
  public function delete_product($product_id)
  {

    $result = $this->db->query("DELETE FROM products WHERE id = ?", array($product_id));

    if ($result) {
      return TRUE;
    } else {
      return FALSE;
    }

  }
  public function add_product($product)
  {
    // LOAD VALIDATION LIBRARY:
    $this->load->library("form_validation");

    // IF FAILS
    if ($this->form_validation->run("create") === FALSE) 
    {

      // Store errors and ship back to controller:
      return array(FALSE, validation_errors());
    } 
    
    // ELSE SUCCESS
    else 
    {
      // Write to database:
      $query = "INSERT INTO products (name, description, price, created_at, updated_at) VALUES (?,?,?,?,?)";

      $values = array($product['name'], $product['description'], $product['price'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));

      return $this->db->query($query, $values);
    }
  }
  public function update_product($product)
  {
    // LOAD VALIDATION LIBRARY:
    $this->load->library("form_validation");

    // IF FAILS
    if ($this->form_validation->run("create") === FALSE) 
    {

      // Store errors and ship back to controller:
      return array(FALSE, validation_errors());
    } 
    
    // ELSE SUCCESS
    else 
    {
      // Write to database:
      $query = "UPDATE products SET name = ?, description = ?, price = ?, updated_at = ? WHERE id = ?";

      $values = array($product['name'], $product['description'], $product['price'], date('Y-m-d H:i:s'), $product["product_id"]);

      return $this->db->query($query, $values);
    }
  }
}
