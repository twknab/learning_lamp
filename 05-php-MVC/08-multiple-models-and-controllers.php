<?php 

// Generally, you'll want to have 1 controller and model for every table in your databse.
// There are 3 ways you can load your models:


/*
1. Load the model just prior to use:
*/
$this->load->model("product");
$this->product->create($post);


/*
2. Load the model in the controller's __construct() method:
*/
class Products extends CI_Controller {
  public function __construct()
  {
    parent::__construct();
    $this->load->model('product');
  }
}

/*
3. Load the model in config/autoload.php:
*/
$autoload['model'] = array('user', 'product', 'order');
