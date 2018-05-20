<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Comment_model extends CI_Model
{
  public function create_comment($comment)
  {
    // Validate:
    if ($this->form_validation->run("comment") === FALSE) // FAILS
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // SUCCESS
    {
      // Write to database:
      $query = "INSERT INTO comments (comment, sender_id, receiver_id, message_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
      $values = array($comment['comment'], $comment['sender_id'], $comment['receiver_id'], $comment['message_id'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
      return $this->db->query($query, $values);
    }
  }
  public function get_all_comments($user_id)
  {
    // Get all comments for user:
    $query = "SELECT comments.id AS id, comments.comment AS comment, comments.message_id AS message_id, users.first_name AS first_name, users.last_name AS last_name, comments.created_at AS created_at, users.id AS user_id FROM comments LEFT JOIN users ON comments.sender_id = users.id WHERE comments.receiver_id = ? ORDER BY comments.created_at ASC";

    $values = array($user_id);
    return $this->db->query($query, $values)->result_array();
  }
}
