<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends CI_Controller
{
  public function index()
  {
    // Create array to hold data:
    $data = [];

    // Check if session:

    // Retrieve last 3 book reviews:

    // Retrieve all book reviews (minus last 3):

    // Load Index Page:
    $this->load->view("dashboard", $data);
  }
}
