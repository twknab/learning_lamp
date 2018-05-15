<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_model extends CI_Model
{
  public function get_all_orders()
  {
    $query = "SELECT * FROM orders ORDER BY created_at DESC";
    return $this->db->query($query)->result_array();
  }
}
