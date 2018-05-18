<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Review_model extends CI_Model
{
  public function validate_review($review)
  {
    // Set custom message and validate review:
    $this->form_validation->set_message('is_unique', 'This %s already exists.');

    if ($this->form_validation->run("review") === FALSE) // FAILS
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // PHASE 1, SUCCESS
    {
      // Validate authors:
      $author = $this->Author_model->validate($review['existing_author'], $review['new_author']);
      if ($author[0] === FALSE)
      {
        return $author;
      }
      else // PHASE 2, SUCCESS
      {
        // $author[1] now holds new author_id
        
        // Validate book title:
        $book = $this->Book_model->validate($review['title'], $author[1]);

        if ($book[0] === FALSE)
        {
          return $book;
        }
        else // PHASE 3, SUCCESS
        {
          // Create review:
          $new_review = $this->create($review['user_id'], $book[1], $review['description'], $review['rating']);
          if ($new_review === FALSE)
          {
            return array(FALSE, "<p>Error creating new review.</p>");
          }
          else
          {
            return TRUE;
          }
        }
      }
    }
  }
  public function create($user_id, $book_id, $description, $rating)
  {
    return $this->db->query("INSERT INTO reviews (user_id, book_id, description, rating, created_at, updated_at) VALUES(?, ?, ?, ?, ?, ?)", array($user_id, $book_id, $description, $rating, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')));
  }
  public function get_recent_reviews()
  {
    // LIMIT TO 3 MOST RECENT
    $query = "SELECT reviews.description AS description, users.name AS name, books.title AS title, reviews.created_at AS created_at FROM reviews RIGHT JOIN books ON reviews.book_id = books.id LEFT JOIN users ON reviews.user_id = users.id";
  }
}
