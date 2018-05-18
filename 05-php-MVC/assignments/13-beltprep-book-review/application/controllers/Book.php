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

      // Get all but recent reviews:
      $data['other_reviews'] = $this->Review_model->get_all_but_recent_reviews();
      
      // Load dashboard with user data:
      $this->load->view("dashboard", $data);
    }
    else 
    {
      redirect('/');
    }
  }
  public function view($book_id)
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get user info via session id:
      $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));

      // Get Book:
      $data['book'] = $this->Book_model->get_book($book_id);
      
      // Get all Reviews for Book:
      $data['reviews'] = $this->Review_model->get_book_reviews($book_id);
      
      // Load dashboard with user data:
      $this->load->view("view_book", $data);
    }
    else 
    {
      redirect('/');
    }
  }
}
