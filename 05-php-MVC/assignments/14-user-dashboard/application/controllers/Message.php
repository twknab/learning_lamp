<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Message extends CI_Controller
{
  public function index()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        // Get Post Data:
        $message = $this->input->post();
        // Run XSS filter (CSRF protection is automatically added in form helper)
        $message = $this->security->xss_clean($message);
        // Ship to model for validation: 
        $new_message = $this->Message_model->create_message($message);
        // If errors are returned, save to flash session, and send back to home:
        if ($new_message[0] === FALSE) {
          $this->session->set_flashdata('errors_message', $new_message[1]);
          redirect("/users/show/" . $message['receiver_id']);
        } 
        else // SUCCESS
        {
          // Redirect to dashboard:
          redirect('/users/show/' . $message['receiver_id']);
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
}