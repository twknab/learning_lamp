<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment extends CI_Controller
{
  public function index()
  {
    // Check for session:
    if ($this->session->userdata('user_id') !== null) 
    {
      if ($this->input->method(TRUE) === 'POST')
      {
        // Get Post Data:
        $comment = $this->input->post();
        // Run XSS filter (CSRF protection is automatically added in form helper)
        $comment = $this->security->xss_clean($comment);
        // Ship to model for validation: 
        $new_comment = $this->Comment_model->create_comment($comment);
        // If errors are returned, save to flash session, and send back to home:
        if ($new_comment[0] === FALSE) {
          $this->session->set_flashdata('errors_comment', $new_comment[1]);
          redirect("/users/show/" . $comment['receiver_id']);
        } 
        else // SUCCESS
        {
          // Redirect to dashboard:
          redirect('/users/show/' . $comment['receiver_id']);
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