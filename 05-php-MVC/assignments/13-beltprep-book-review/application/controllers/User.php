<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function index()
  {
    // Create array to hold data:
    $data = [];
    // Get any flash message errors for registration:
    if ($this->session->flashdata('errors_registration')) 
    {
      $data["errors_registration"] = $this->session->flashdata('errors_registration');
    }
    // Get any flash message errors for login:
    if ($this->session->flashdata('errors_login')) 
    {
      $data["errors_login"] = $this->session->flashdata('errors_login');
    }
    // Load Index Page:
    $this->load->view("main", $data);
  }
  public function login()
  {
    // Get Post Data:
    $user = $this->input->post();
    // Run XSS filter (CSRF protection is automatically added in form helper)
    $user = $this->security->xss_clean($user);
    // Ship to model for validation: 
    $found_user = $this->User_model->login_user($user);
    // If errors are returned, save to flash session, and send back to home:
    if ($found_user[0] === FALSE) {
      $this->session->set_flashdata('errors_login', $found_user[1]);
      redirect("/");
    } else // SUCCESS
    {
      // Store user_id to session,
      $this->session->set_userdata('user_id', $found_user[1]['id']);
      // Redirect to dashboard:
      redirect('/books');
    }


  }
  public function register()
  {
    // Get Post Data:
    $user = $this->input->post();
    // Run XSS filter (CSRF protection is automatically added in form helper)
    $user = $this->security->xss_clean($user);
    // Ship to model for validation:
    $new_user = $this->User_model->register_user($user);

    // If errors are returned, save to flash session, and send back to home:
    if ($new_user[0] === FALSE)
    {
      $this->session->set_flashdata('errors_registration', $new_user[1]);
      redirect("/");
    }
    else // SUCCESS
    {
      // Store user_id to session, 
      $this->session->set_userdata('user_id', $new_user[1]);
      // Redirect to dashboard:
      redirect('/books');
    }
  }
  public function logoff()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      // Clear session data: 
      $this->session->unset_userdata('user_id');
      // Go back home:
      redirect('/');
    } 
    else
    {
      redirect('/');
    }
  }
  public function dashboard()
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get user info via session id:
      $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
      
      // Load dashboard with user data:
      $this->load->view("dashboard", $data);
    }
    else 
    {
      redirect('/');
    }
  }
  public function view($id)
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get user by id:
      $data['user'] = $this->User_model->get_user($id);
      
      // Get user reviews count:
      $data['reviews_count'] = $this->Review_model->get_user_review_count($id);

      // Get reviews for user:
      $data['reviews'] = $this->Review_model->get_user_reviews($id);

      // Load dashboard with user data:
      $this->load->view("view_user", $data);
    }
    else 
    {
      redirect('/');
    }
  }
}
