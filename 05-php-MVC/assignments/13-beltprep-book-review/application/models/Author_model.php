<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Author_model extends CI_Model
{
  public function get_all_authors()
  {
    return $this->db->query("SELECT * FROM authors ORDER BY name DESC")->result_array();
  }
  public function validate($existing_author, $new_author)
  {
    if ($existing_author && $new_author) 
    {
      return array(FALSE, "<p>Existing author and new author cannot both be submitted.</p>");
    }
    if (!$existing_author && !$new_author) 
    {
      return array(FALSE, "<p>Existing Author or New Author is required.</p>");
    }
    if ($existing_author)
    {
      // Return existing author:
      return array(TRUE, $existing_author);
    }
    if ($new_author)
    {
      // Create author:
      $author = $this->create($new_author);

      if ($author === FALSE)
      {
        return array(FALSE, "<p>Error creating new Author.</p>");
      }
      else
      {
        return array(TRUE, $this->db->insert_id());
      }
      
    }
  }
  public function create($name)
  {
    return $this->db->query("INSERT INTO authors (name, created_at, updated_at) VALUES (?, ?, ?)", array($name, date('Y-m-d H:i:s'), date('Y-m-d H:i:s')));
  }
}
