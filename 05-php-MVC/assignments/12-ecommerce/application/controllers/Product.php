<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
  public function index()
  {
    $data = []; // holds data
    // Check for any flash data:
    if ($this->session->flashdata('errors'))
    {
      $data["errors"] = $this->session->flashdata('errors');
    }
    // Load models:
    $this->load->model('Product_model');
    $this->load->model('Order_model');
    // Get products and orders:
    $data['products'] = $this->Product_model->get_all_products();
    $data['order_count'] = count($this->Order_model->get_all_orders());
    // If new user, assign new session, else load products/orders:
    if ($this->session->userdata('logged_in') === NULL) 
    {
      $this->session->set_userdata('logged_in',TRUE);
      if (count($data['products']) < 1)
      {
        // Create 5 demo products:
        $data['products'] = $this->Product_model->demo_products();
        foreach ($data['products'] as $status) {
          if ($status === FALSE) 
          {
            echo "Error creating all demo products.";
          }
        }
        $data['products'] = $this->Product_model->get_all_products();
      }
    }
    // Load Index Page:
    $this->load->view("main", $data);
  }
  public function get_all()
  {
    // Create array to hold data:
    $data = [];
    // Load Product and Orders model:
    $this->load->model('Product_model');
    // Retrieve any existing products:
    $data['products'] = $this->Product_model->get_all_products();
    // Load Index Page:
    $this->load->view("main", $data);
  }
}
