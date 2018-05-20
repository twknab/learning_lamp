<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function signin()
  {
    if ($this->input->method(TRUE) === 'GET')
    {
      // Create array to hold data:
      $data = [];
      // Get any flash message errors for login:
      if ($this->session->flashdata('errors_login')) 
      {
        $data["errors_login"] = $this->session->flashdata('errors_login');
      }
      // Load Index Page:
      $this->load->view("user_signin", $data);
    } 
    else if ($this->input->method(TRUE) === 'POST')
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
      } 
      else // SUCCESS
      {
        // Store user_id to session,
        $this->session->set_userdata('user_id', $found_user[1]['id']);
        // Redirect to dashboard:
        redirect('/books');
      }
    }
  }
  public function register()
  {
    if ($this->input->method(TRUE) === 'GET')
    {
      // Create array to hold data:
      $data = [];
      // Get any flash message errors for login:
      if ($this->session->flashdata('errors_registration')) 
      {
        $data["errors_registration"] = $this->session->flashdata('errors_registration');
      }
      // Load Index Page:
      $this->load->view("user_register", $data);
    } 
    else if ($this->input->method(TRUE) === 'POST')
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
        redirect("/register");
      }
      else // SUCCESS
      {
        // Store user_id to session, 
        $this->session->set_userdata('user_id', $new_user[1]);

        // Get user's user level:
        $access_level = $this->User_model->get_user($new_user[1]);
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
  public function profile()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'GET')
      {
        // Create Array to hold Data:
        $data = [];
        // Get Logged In User:
        $data['logged_in'] = $this->User_model->get_user($this->session->userdata('user_id'));
        // Load Index Page:
        $this->load->view("user_profile", $data);
      } 
      else if ($this->input->method(TRUE) === 'POST')
      {
        echo "UPDATING";
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function update_info()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        echo "UPDATING";
      } 
      else 
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function update_pass()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        echo "UPDATING";
      } 
      else 
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function update_desc()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        echo "UPDATING";
      } 
      else 
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function admin_update_info()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        echo "UPDATING";
      } 
      else 
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function admin_update_pass()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        echo "UPDATING";
      } 
      else 
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function show_user($user_id)
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      // Get any Flash Errors for Comments or Messages:
      if ($this->session->flashdata('errors_message')) 
      {
        $data["errors_message"] = $this->session->flashdata('errors_message');
      }
      if ($this->session->flashdata('errors_comment')) 
      {
        $data["errors_comment"] = $this->session->flashdata('errors_comment');
      }

      // Get Logged In User:
      $data['logged_in'] = $this->User_model->get_user($this->session->userdata('user_id'));

      // Get user by $user_id:
      $data['user'] = $this->User_model->get_user($user_id);

      // Get All Messages with sender_id name Joined for $user_id as receiver_id:
      $data['messages'] = [];

      // Get All Comments with sender_id name Joined for $user_id as receiver_id:
      $data['comments'] = [];

      // Load View User Page:
      $this->load->view('user_view', $data);
    } 
    else
    {
      redirect('/');
    }
  }
}
