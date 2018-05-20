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
        redirect("/signin");
      } 
      else // SUCCESS
      {
        // Store user_id to session,
        $this->session->set_userdata('user_id', $found_user[1]['id']);
        // Redirect to dashboard:
        redirect('/load_dashboard');
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
        if ($this->input->post('form_name') === 'register')
        {
          $this->session->set_flashdata('errors_registration', $new_user[1]);
          redirect("/register");
        }
        else if ($this->input->post('form_name') === 'admin_add_user')
        {
          $this->session->set_flashdata('errors_new_user', $new_user[1]);
          redirect("/users/new");
        }

      }
      else // SUCCESS
      {
        if ($this->input->post('form_name') === 'register')
        {
          // Store user_id to session, 
          $this->session->set_userdata('user_id', $new_user[1]);
        }
        // Load dashboard:
        redirect('/load_dashboard');
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
  public function admin_add_user()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'GET')
      {
        $data = [];
         // Get any flash message errors:
        if ($this->session->flashdata('errors_new_user')) 
        {
          $data["errors_new_user"] = $this->session->flashdata('errors_new_user');
        }
        // Load Index Page:
        $this->load->view("user_admin_add", $data);
      } 
      else if ($this->input->method(TRUE) === 'POST')
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
  public function admin_edit_user($user_id)
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'GET')
      {
        $data = [];
         // Get any flash message errors:
        if ($this->session->flashdata('errors_info')) 
        {
          $data["errors_info"] = $this->session->flashdata('errors_info');
        }
        if ($this->session->flashdata('errors_password')) 
        {
          $data["errors_password"] = $this->session->flashdata('errors_password');
        }
        // Get user:
        $data['user'] = $this->User_model->get_user($user_id);
        // Load Index Page:
        $this->load->view("user_admin_edit", $data);
      } 
      else if ($this->input->method(TRUE) === 'POST')
      {
        redirect('/');
      }
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
        // Get any flash message errors:
        if ($this->session->flashdata('errors_info')) 
        {
          $data["errors_info"] = $this->session->flashdata('errors_info');
        }
        if ($this->session->flashdata('errors_password')) 
        {
          $data["errors_password"] = $this->session->flashdata('errors_password');
        }
        if ($this->session->flashdata('errors_desc')) 
        {
          $data["errors_desc"] = $this->session->flashdata('errors_desc');
        }

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
        // Get Post Data:
        $user_info = $this->input->post();
        // Run XSS filter (CSRF protection is automatically added in form helper)
        $user_info = $this->security->xss_clean($user_info);
  
        // If normal edit user form:
        if ($user_info['form_name'] === 'edit_info')
        {
          // Ship to model for validation:
          $update_info = $this->User_model->update_user_info($user_info);
          // If errors are returned, save to flash session, and send back to home:
          if ($update_info[0] === FALSE)
          {
            $this->session->set_flashdata('errors_info', $update_info[1]);
          }
          // Load user edit page again:
          redirect('/users/edit');
        }
        // If admin edit user form:
        else if ($user_info['form_name'] === 'admin_edit_info')
        {
          // Ship to model for validation:
          $update_info = $this->User_model->admin_update_user_info($user_info);
          // If errors are returned, save to flash session, and send back to home:
          if ($update_info[0] === FALSE)
          {
            $this->session->set_flashdata('errors_info', $update_info[1]);
          }
          // Load admin user edit page:
          redirect('/users/edit/' . $user_info['user_id']);
        }
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
        // Get Post Data:
        $updated_password = $this->input->post();
        // Run XSS filter (CSRF protection is automatically added in form helper)
        $updated_password = $this->security->xss_clean($updated_password);
        // Ship to model for validation:
        $update_pass = $this->User_model->update_user_password($updated_password);
        // If errors are returned, save to flash session, and send back to home:
        if ($update_pass[0] === FALSE)
        {
          $this->session->set_flashdata('errors_password', $update_pass[1]);
        }
        if ($updated_password['form_name'] === 'edit_pass')
        {
          // Load user edit page again:
          redirect('/users/edit');
        }
        else if ($updated_password['form_name'] === 'admin_edit_pass')
        {
          // Load admin edit page again:
          redirect('/users/edit/' . $updated_password['user_id']);
        }
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
        // Get Post Data:
        $updated_desc = $this->input->post();
        // Run XSS filter (CSRF protection is automatically added in form helper)
        $updated_desc = $this->security->xss_clean($updated_desc);
        // Ship to model for validation:
        $description = $this->User_model->update_user_desc($updated_desc);
        // If errors are returned, save to flash session, and send back to home:
        if ($description[0] === FALSE)
        {
          $this->session->set_flashdata('errors_desc', $description[1]);
        }
        // Load user edit page again:
        redirect('/users/edit');
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
      $data['messages'] = $this->Message_model->get_all_messages($user_id);

      // Get All Comments with sender_id name Joined for $user_id as receiver_id:
      $data['comments'] = $this->Comment_model->get_all_comments($user_id);

      // Load View User Page:
      $this->load->view('user_view', $data);
    } 
    else
    {
      redirect('/');
    }
  }
  public function destroy_user($user_id)
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'GET')
      {
        // Destroy user:
        $destroyed_user = $this->User_model->delete_user($user_id);

        if ($destroyed_user === FALSE)
        {
          echo "Error deleting user! Contact admin!";
          die();
        }
        else 
        {
          if (intval($user_id) === intval($this->session->userdata('user_id')))
          {
            $this->logoff();
          } 
          else
          {
            redirect('/load_dashboard');
          }
        }
      } 
      else if ($this->input->method(TRUE) === 'POST')
      {
        redirect('/');
      }
    } 
    else
    {
      redirect('/');
    }
  }
}
