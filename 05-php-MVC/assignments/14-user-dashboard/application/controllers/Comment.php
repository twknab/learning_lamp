<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment extends CI_Controller
{
  public function index()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      echo "UPDATING";
      // Create new comment (validate).
      // If errors, OR no errors, redirect to receiver_id user profile page:
    } 
    else
    {
      redirect('/');
    }
  }
}
