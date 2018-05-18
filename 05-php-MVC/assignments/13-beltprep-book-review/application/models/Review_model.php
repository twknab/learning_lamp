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
    $query = "SELECT reviews.id AS review_id, reviews.description AS description, users.name AS name, users.id AS user_id, books.title AS title, books.id AS book_id, reviews.rating AS rating, reviews.created_at AS created_at FROM reviews RIGHT JOIN books ON reviews.book_id = books.id LEFT JOIN users ON reviews.user_id = users.id GROUP BY title ORDER BY reviews.created_at DESC LIMIT 3";

    return $this->db->query($query)->result_array();
  }
  public function get_all_but_recent_reviews()
  {
    $ids = array();
    $top3 = $this->get_recent_reviews();
    foreach ($top3 as $review) {
      $ids[] = $review['book_id'];
    }

    if (count($ids) > 0)
    {
      $query = "SELECT books.title, books.id AS book_id FROM reviews RIGHT JOIN books ON reviews.book_id = books.id LEFT JOIN users ON reviews.user_id = users.id WHERE books.id NOT IN ? GROUP BY books.title ORDER BY reviews.created_at DESC";
  
      $val = array($ids); // note array has to be nested to iterate through IDs
  
      return $this->db->query($query, $val)->result_array();
    }
    else
    {
      return array();
    }

  }
  public function get_book_reviews($book_id)
  {
    $query = "SELECT users.id AS user_id, users.name, users.alias, reviews.id, reviews.description, reviews.rating, reviews.created_at, books.id AS book_id FROM reviews RIGHT JOIN books ON reviews.book_id = books.id LEFT JOIN users ON reviews.user_id = users.id WHERE books.id = ? ORDER BY reviews.created_at DESC";
    $val = array($book_id);

    return $this->db->query($query, $val)->result_array();
  }
  public function destroy($review_id)
  {
    $query = "DELETE FROM reviews WHERE id = ?";
    $val = array($review_id);

    return $this->db->query($query, $val);
  }
  public function get_user_reviews($user_id)
  {
    $query = "SELECT * FROM reviews RIGHT JOIN books ON reviews.book_id = books.id WHERE user_id = ? GROUP BY books.title ORDER BY reviews.created_at DESC";
    $val = array($user_id);

    return $this->db->query($query, $val)->result_array();
  }
  public function get_user_review_count($user_id)
  {
    $query = "SELECT COUNT(id) AS total_reviews FROM reviews WHERE user_id = ?";
    $val = array($user_id);

    return $this->db->query($query, $val)->row();
  }
}
