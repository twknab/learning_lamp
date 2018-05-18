<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function get_user($user_id)
  {
    return $this->db->query("SELECT * FROM users WHERE id = ?", array($user_id))->row_array();
  }
  public function delete_user($user_id)
  {
    $result = $this->db->query("DELETE FROM users WHERE id = ?", array($user_id));
    if ($result) {
      return TRUE; // USER DELETED
    } else {
      return FALSE; // FAILS
    }
  }
  public function register_user($user)
  {
    // Validate registration:
    $this->form_validation->set_message('is_unique', 'This %s is already registered.');
    $this->form_validation->set_message('matches', 'The %s must match the %s.');
    if ($this->form_validation->run("register") === FALSE) // FAILS
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // SUCCESS
    {
      // Create salt and encrypt password:
      $salt = bin2hex(openssl_random_pseudo_bytes(22));
      $encrypted_password = md5($user['password'] . "" . $salt);

      // Write to database:
      $query = "INSERT INTO users (name, alias, email, password, salt, created_at, updated_at) VALUES (?,?,?,?,?,?,?)";
      $values = array($user['name'], $user['alias'], $user['email'], $encrypted_password, $salt, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
      return array($this->db->query($query, $values), $this->db->insert_id()); // note: insert_id retrieves last ID
    }
  }
  public function login_user($user)
  {
    // Validate login:
    if ($this->form_validation->run("login") === FALSE) // FAILS
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // SUCCESS
    {
      // Get user by email and return user:
      $found_user = $this->db->query("SELECT * FROM users WHERE email = ?", array($user['email']))->row_array();
      // If email not found:
      if (!$found_user) // EMAIL NOT FOUND
      {
        return array(false, "<p>Invalid login.</p>");
      }
      // Decrypt password and use salt to compare to entered password:
      $encrypted_password = md5($user['password'] . "" . $found_user["salt"]);
      // If salted encryption matches the key stored for the user, it's a match!
      if ($found_user["password"] === $encrypted_password) 
      {
        return array(TRUE, $found_user);
      }
      else 
      { // INCORRECT PASSWORD
        // Note: This error message is NOT intended to reveal whether user does not exist, or password mismatch. Not including this information is aimed to minimize malicious login attempts.
        return array(FALSE, "<p>Invalid login.</p>");
      }
    }
  }
}
