<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function index()
  {
    // Create array to hold data:
    $data = [];
    // Get any flash message errors
    if ($this->session->flashdata('errors_registration')) 
    {
      $data["errors_registration"] = $this->session->flashdata('errors_registration');
    }
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
    $this->__load_model('User_model');
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
      redirect('/dashboard');
    }


  }
  public function register()
  {
    // Get Post Data:
    $user = $this->input->post();
    // Run XSS filter (CSRF protection is automatically added in form helper)
    $user = $this->security->xss_clean($user);
    // Ship to model for validation:
    $this->__load_model('User_model');
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
      redirect('/dashboard');
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

      // If true, delete session data and go to home page.
      // If false, redirect home.
    echo "LOGGING OFF";
  }
  public function dashboard()
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get user by session id:
      $this->__load_model('User_model');
      $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));
      // Load dashboard with user data:
      $this->load->view("dashboard", $data);
    }
    else 
    {
      redirect('/');
    }
  }
  private function __load_model($Model_name) {
    return $this->load->model($Model_name);
  }
}
