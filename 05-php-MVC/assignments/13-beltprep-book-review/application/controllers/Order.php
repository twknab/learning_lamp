<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
  public function new_order()
  {
    $data = [];
    $post_data = $this->input->post();

    $this->load->model('Product_model'); // load model
    $this->load->model('Order_model'); // load model
    
    // Reduce product inventory:
    $reduce_inv = $this->Product_model->reduce_inventory($post_data["quantity"], $post_data['product_id']);

    if ($reduce_inv[0] === FALSE)
    {
      $this->session->set_flashdata('errors', $reduce_inv[1]);
      redirect('/');
    } 
    else
    {
      // Create new order:
      $result = $this->Order_model->new_order($post_data);
      if ($result === FALSE)
      {
        $this->session->set_flashdata('errors', 'Error creating order. Please contact administrator.');
      }
    }
    redirect('/');
  }
  public function cart()
  {
    $data = [];
    // Get all orders (and products):
    $this->load->model('Order_model');
    $data["orders"] = $this->Order_model->get_all_orders_and_products();
    if ($data["orders"] === FALSE)
    {
      $this->session->set_flashdata('errors', 'Error retrieving all orders and their products.');
      redirect('/');
    }

    // Get sum of total orders:
    $data["sum"] = 0;
    foreach ($data["orders"] as $order) {
      $data["sum"] += ($order['price'] * $order['quantity']);
    }

    // Load Cart:
    $this->load->view("checkout", $data);
  }
  public function delete()
  {
    // Get all orders (and products):
    $this->load->model('Order_model');
    $result = $this->Order_model->delete_order($this->input->post());
    if ($result === FALSE)
    {
      $this->session->set_flashdata('errors', 'Error deleting order.');
      redirect('/');
    }


    // Load Cart:
    redirect('/cart');
  }
  public function checkout()
  {
    $this->load->view('thank_you');
  }
}
