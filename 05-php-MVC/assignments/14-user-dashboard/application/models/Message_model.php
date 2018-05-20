<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Message_model extends CI_Model
{
  public function create_message($message)
  {
    // Validate:
    if ($this->form_validation->run("message") === FALSE) // FAILS
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // SUCCESS
    {
      // Write to database:
      $query = "INSERT INTO messages (message, sender_id, receiver_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";
      $values = array($message['message'], $message['sender_id'], $message['receiver_id'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
      return $this->db->query($query, $values);
    }
  }
  public function get_all_messages($user_id)
  {
    // Get all messages for user:
    $query = "SELECT messages.id AS id, messages.message AS message, users.first_name AS first_name, users.last_name AS last_name, messages.created_at AS created_at, users.id AS user_id FROM messages LEFT JOIN users ON messages.sender_id = users.id WHERE messages.receiver_id = ? ORDER BY messages.created_at DESC";

    // $asd = " INTO messages (message, sender_id, receiver_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";

    $values = array($user_id);
    return $this->db->query($query, $values)->result_array();
  }
}
