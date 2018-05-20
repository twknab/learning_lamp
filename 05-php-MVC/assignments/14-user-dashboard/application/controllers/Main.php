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
      if (intval($data['logged_in']['user_level']) !== 9)
      { // NORMAL USER DETECTED
        redirect('/dashboard');
      }
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
  public function dashboard_user()
  {
    // Array to hold data for dashboard:
    $data = [];
    // Check for valid session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get Logged In User:
      $data['logged_in'] = $this->User_model->get_user($this->session->userdata('user_id'));
      if (intval($data['logged_in']['user_level']) === 9)
      { // ADMIN DETECTED
        redirect('/dashboard/admin');
      }
      // Get All Users:
      $data['users'] = $this->User_model->get_all_users();
      // Load User Dashboard Page:
      $this->load->view("dashboard_user", $data);
    }
    else 
    {
      redirect('/');
    }
  }
  public function load_dashboard()
  {
    $data = [];
    // Check for valid session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get user's user level:
      $access_level = $this->User_model->get_user($this->session->userdata('user_id'));
      if (intval($access_level['user_level']) === 9)
      { // ADMIN DETECTED
        redirect('/dashboard/admin');
      }
      else
      {
        // Redirect to normal dashboard:
        redirect('/dashboard');
      }
    }
    else 
    {
      redirect('/');
    }
  }
}
