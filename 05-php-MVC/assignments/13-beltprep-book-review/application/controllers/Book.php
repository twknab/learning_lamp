<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book extends CI_Controller
{
  public function dashboard()
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get user info via session id:
      $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));

      // Get most recent reviews:
      $data['reviews'] = $this->Review_model->get_recent_reviews();
      
      // Load dashboard with user data:
      $this->load->view("dashboard", $data);
    }
    else 
    {
      redirect('/');
    }
  }
}
