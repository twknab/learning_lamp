<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Book_model extends CI_Model
{
  public function validate($title, $author_id)
  {
    $exists = $this->db->query("SELECT * FROM books WHERE title = ?", array($title))->row();

    if ($exists !== NULL) // Book exists:
    {
      // Return array with true and id:
      return array(TRUE, $exists->id);
    }
    else
    {
      // Create book:
      $book = $this->create($title, intval($author_id));

      if ($book !== FALSE) // SUCCESS
      {
        return array(TRUE, $this->db->insert_id());
      }
      else
      {
        return array(FALSE, "<p>Error creating book.</p>");
      }
    }
  }
  public function create($title, $author_id)
  {
    return $book = $this->db->query("INSERT INTO books (author_id, title, created_at, updated_at) VALUES (?, ?, ?, ?)", array($author_id, $title, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')));
  }
  public function get_book($book_id)
  {
    return $this->db->query("SELECT * FROM books RIGHT JOIN authors ON books.author_id = authors.id WHERE books.id = ?", array($book_id))->row();
  }
}
