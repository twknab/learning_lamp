<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
  public function buy()
  {
    $data = [];
    $post_data = $this->input->post();
    $post_data['new_inventory'] = $post_data['inventory'] - $post_data['quantity'];

    $this->load->model('Product_model'); // load model
    $this->load->model('Order_model'); // load model
    
    // Reduce product inventory:
    $reduce_inv = $this->Product_model->reduce_inventory($post_data["quantity"], $post_data["inventory"]-$post_data["quantity"], $post_data['product_id']);

    if ($reduce_inv[0] === FALSE)
    {
      $this->session->flash_data('errors', $reduce_inv[1]);
    } 
    else
    {
      // Create new order 
    }
    redirect('/');
  }
}
