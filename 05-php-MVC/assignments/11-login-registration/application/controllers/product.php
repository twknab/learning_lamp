<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
  public function index()
  {
    redirect("/products");
  }
  public function home()
  {
    // Create empty array for data:
    $data = array();

    // GET ALL PRODUCTS
    $this->__getModel("Product_model");
    $data["products"] = $this->Product_model->get_all_products();

    // Load Index Page:
    $this->load->view("main", $data);
  }
  function new () {
    // ARRAY FOR DATA
    $data = array();

    // GET ANY FLASH MESSAGE ERRORS
    if ($this->session->flashdata('errors')) {
      $data["errors"] = $this->session->flashdata('errors');
    }

    // LOAD ADD PRODUCT PAGE:
    $this->load->view("add_product", $data);
  }
  public function create()
  {
    // XSS FILTER $POST OBJECT
    $new_product = $this->input->post(null, true);

    // SEND TO MODEL
    $this->__getModel("Product_model");
    $product = $this->Product_model->add_product($new_product);

    // IF FALSE, STORE ERRORS IN FLASH SESSION
    if ($product[0] === false) {
      $this->session->set_flashdata('errors', $product[1]);
      redirect("/products/new");
    } else {

      // IF TRUE, SEND HOME
      redirect("/");
    }
  }
  public function show($product_id)
  {
    // CREATE ARRAY TO HOLD DATA
    $data = array();

    // LOAD MODEL
    $this->__getModel("Product_model");
    // GET PRODUCT
    $product = $this->Product_model->get_product($product_id);

    if ($product === false) {
      // PRODUCT NOT FOUND, REDIRECT HOME
      redirect('/');
    }

    // STORE PRODUCT
    $data["product"] = $product;

    // LOAD SHOW PRODUCT PAGE AND SHIP DATA ARRAY
    $this->load->view("show_product", $data);
  }
  public function edit($product_id)
  {
    // CREATE ARRAY TO HOLD DATA
    $data = array();

    // GET ANY FLASH MESSAGE ERRORS
    if ($this->session->flashdata('errors')) {
      $data["errors"] = $this->session->flashdata('errors');
    }

    // LOAD MODEL
    $this->__getModel("Product_model");
    // GET PRODUCT
    $product = $this->Product_model->get_product($product_id);

    if ($product === false) {
      // PRODUCT NOT FOUND, REDIRECT HOME
      redirect('/');
    }

    // STORE PRODUCT
    $data["product"] = $product;

    // LOAD EDIT PRODUCT PAGE AND SHIP DATA ARRAY
    $this->load->view("edit_product", $data);
  }
  public function update($product_id)
  {
    // XSS FILTER $POST OBJECT
    $updated_product = $this->input->post(null, true);

    // SEND TO MODEL
    $this->__getModel("Product_model");
    $product = $this->Product_model->update_product($updated_product);

    // IF FALSE, STORE ERRORS IN FLASH SESSION
    if ($product[0] === false) {
      $this->session->set_flashdata('errors', $product[1]);
      redirect("/products/edit/${product_id}");
    } else {

      // IF TRUE, SEND HOME
      redirect("/");
    }

  }
  public function destroy($product_id)
  {
    $this->__getModel("Product_model");
    $destroy = $this->Product_model->delete_product($product_id);

    if ($destroy === FALSE)
    {
      echo "Error deleting product. Contact server administrator.";
      die();
    }

    redirect("/");
  }
  private function __getModel($Model_name) {
    return $this->load->model($Model_name);
  }
}
