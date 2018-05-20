<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{
  public function index()
  {
     // Load Index Page:
    $this->load->view("main");
  }
  public function dashboard_admin()
  {
    // Array to hold data for dashboard:
    $data = [];
    // Check for valid session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get Logged In User:
      $data['logged_in'] = $this->User_model->get_user($this->session->userdata('user_id'));
      // Get All Users:
      $data['users'] = $this->User_model->get_all_users();
      // Load Admin Dashboard Page:
      $this->load->view("dashboard_admin", $data);
    }
    else 
    {
      redirect('/');
    }
  }
  public function dashboard()
  {
    $data = [];
    // Check for valid session:
      // Get User:
      // Get All Users:

    // Load Normal User Dashboard Page:
    $this->load->view("dashboard", $data);
  }
}
