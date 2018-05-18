<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review extends CI_Controller
{
  public function add()
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get any flash messages:
      if ($this->session->flashdata('errors_review')) 
      {
        $data["errors_review"] = $this->session->flashdata('errors_review');
      }
      // Get user info via session id:
      $data['user'] = $this->User_model->get_user($this->session->userdata('user_id'));

      // Get existing authors:
      $data['authors'] = $this->Author_model->get_all_authors();
      
      // Load dashboard with user data:
      $this->load->view("add_review", $data);
    }
    else 
    {
      redirect('/');
    }
  }
  public function create()
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get Post Data:
      $review = $this->input->post();

      // Run XSS filter (CSRF protection is automatically added in form helper)
      $review = $this->security->xss_clean($review);

      // Ship to model for validation:
      // Errors will be returned, else new review will be created
      $new_review = $this->Review_model->validate_review($review);

      // If errors are returned, save to flash session, and send back to home:
      if ($new_review[0] === FALSE)
      {
        $this->session->set_flashdata('errors_review', $new_review[1]);
        redirect("/books/add");
      }
      else // SUCCESS
      {
        // Redirect to dashboard:
        redirect('/books');
      }
    }
    else 
    {
      redirect('/');
    }
  }
  public function quick_create()
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      // Get Post Data:
      $review = $this->input->post();

      // Run XSS filter (CSRF protection is automatically added in form helper)
      $review = $this->security->xss_clean($review);

      // Ship to model for validation:
      // Errors will be returned, else new review will be created
      $new_review = $this->Review_model->validate_review($review);

      // If errors are returned, save to flash session, and send back to home:
      if ($new_review[0] === FALSE)
      {
        $this->session->set_flashdata('errors_review', $new_review[1]);
        redirect("/books/" . $review['book_id']);
      }
      else // SUCCESS
      {
        // Redirect to book page:
        redirect("/books/" . $review['book_id']);
      }
    }
    else 
    {
      redirect('/');
    }
  }
  public function delete($review_id, $book_id)
  {
    $data = [];

    // Check for session:
    if ($this->session->userdata('user_id') !== NULL)
    {
      $destroy_review = $this->Review_model->destroy($review_id);

      // If errors are returned, save to flash session, and send back to home:
      if ($destroy_review === FALSE)
      {
        echo "Error deleting review!";
      }
      else // SUCCESS
      {
        // Retrieve all reviews for book, if no more reviews, delete book:
        $book_reviews = $this->Review_model->get_book_reviews($book_id);

        // var_dump($book_reviews);

        // If no reviews, delete book:
        if (count($book_reviews) < 1 || $book_reviews[0]['id'] === NULL)
        {
          $destroy_book = $this->Book_model->destroy($book_id);

          if ($destroy_book === FALSE)
          {
            echo "Error deleting book with no reviews!";
          }
          else // BOOK DELETE GO HOME
          {
            redirect('/books');
          }
        }
        // Redirect to view book page:
        redirect('/books/' . $book_id);
      }
    }
    else 
    {
      redirect('/');
    }
  }
}
