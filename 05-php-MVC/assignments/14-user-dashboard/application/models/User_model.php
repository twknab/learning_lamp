<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function get_user($user_id)
  {
    return $this->db->query("SELECT * FROM users WHERE id = ?", array($user_id))->row_array();
  }
  public function get_all_users()
  {
    return $this->db->query("SELECT * FROM users ORDER BY last_name ASC")->result_array();
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
      
      // Get all users, if less than 1 user, set first user to admin, set any others to regular user:
      $users = $this->get_all_users();
      if (count($users) < 1)
      {
        $user_level = 9;
      }
      else
      {
        $user_level = 1;
      }
      
      // Write to database:
      $query = "INSERT INTO users (first_name, last_name, email, password, salt, user_level, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $values = array($user['first_name'], $user['last_name'], $user['email'], $encrypted_password, $salt, $user_level, $user['description'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
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
  public function delete_user($user_id)
  {
    // $del_messages = $this->db->query("DELETE FROM messages WHERE receiver_id = ? OR sender_id = ?", array($user_id, $user_id));
    // $del_comments = $this->db->query("DELETE FROM comments WHERE receiver_id = ? OR sender_id = ?", array($user_id, $user_id));
    $del_user = $this->db->query("DELETE FROM users WHERE id = ?", array($user_id));

    if ($del_user) {
      return TRUE; // USER DELETED
    } else {
      return FALSE; // FAILS
    }
  }
  public function update_user_info($info)
  {
    // See if anything has changed:
    $user = $this->get_user($this->session->userdata('user_id'));
    if ($user['email'] === $info['email'] && $user['first_name'] === $info['first_name'] && $user['last_name'] === $info['last_name'])
    {
      return array(FALSE, "<p>No user details were changed.</p>");
    }
    // Validate update:
    // If email has not changed, only validate first and last name:
    if ($user['email'] === $info['email'])
    {
      // Validate all fields excluding email:
      if ($this->form_validation->run("edit_user_info_no_email") === FALSE)
      {
        // Ship errors back to controller:
        return array(FALSE, validation_errors());
      } 
      else // SUCCESS
      {
        // Write to database:
        $query = "UPDATE users SET first_name = ?, last_name = ?, updated_at = ? WHERE id = ?";
        $values = array($info['first_name'], $info['last_name'], date('Y-m-d H:i:s'), $this->session->userdata('user_id'));
        $result = $this->db->query($query, $values);
        if ($result) {
          return TRUE; // USER INFO UPDATED
        } else {
          return array(FALSE, validation_errors()); // UPDATE FAILS
        }
      }
    }
    else  // Otherwise, also validate email:
    {
      $this->form_validation->set_message('is_unique', 'This %s is already registered.');
      if ($this->form_validation->run("edit_user_info") === FALSE) // FAILS
      {
        // Ship errors back to controller:
        return array(FALSE, validation_errors());
      } 
      else  // SUCCESS
      {
        // Write to database:
        $query = "UPDATE users SET email = ?, first_name = ?, last_name = ?, updated_at = ? WHERE id = ?";
        $values = array($info['email'], $info['first_name'], $info['last_name'], date('Y-m-d H:i:s'), $this->session->userdata('user_id'));
        $result = $this->db->query($query, $values);
        if ($result) {
          return TRUE; // USER INFO UPDATED
        } else {
          return array(FALSE, validation_errors()); // UPDATE FAILS
        }
      }
    }
  }
  public function admin_update_user_info($info)
  {
    // See if anything has changed:
    $user = $this->get_user($info['user_id']);

    if ($user['email'] === $info['email'] && $user['first_name'] === $info['first_name'] && $user['last_name'] === $info['last_name'] && intval($user['user_level']) === intval($info['user_level']))
    {
      return array(FALSE, "<p>No user details were changed.</p>");
    }
    // Validate update:
    // If email has not changed, only validate first, last name, user level:
    if ($user['email'] === $info['email'])
    {
      // Validate all fields excluding email:
      if ($this->form_validation->run("admin_edit_user_info_no_email") === FALSE)
      {
        // Ship errors back to controller:
        return array(FALSE, validation_errors());
      } 
      else // SUCCESS
      {
        if (intval($this->get_user($this->session->userdata['user_id'])['user_level']) === 9)
        {
          // Write to database:
          $query = "UPDATE users SET first_name = ?, last_name = ?, user_level = ?, updated_at = ? WHERE id = ?";
          $values = array($info['first_name'], $info['last_name'], $info['user_level'], date('Y-m-d H:i:s'), $info['user_id']);
          $result = $this->db->query($query, $values);
          if ($result) {
            return TRUE; // USER INFO UPDATED
          } else {
            return array(FALSE, validation_errors()); // UPDATE FAILS
          }
        }
        else 
        {
          echo "DENIED.";
          die();
        }
      }
    }
    else  // Otherwise, also validate email:
    {
      $this->form_validation->set_message('is_unique', 'This %s is already registered.');
      if ($this->form_validation->run("admin_edit_user_info") === FALSE) // FAILS
      {
        // Ship errors back to controller:
        return array(FALSE, validation_errors());
      } 
      else  // SUCCESS
      {
        // Write to database:
        $query = "UPDATE users SET email = ?, first_name = ?, last_name = ?, updated_at = ? WHERE id = ?";
        $values = array($info['email'], $info['first_name'], $info['last_name'], date('Y-m-d H:i:s'), $info['user_id']);
        $result = $this->db->query($query, $values);
        if ($result) {
          return TRUE; // USER INFO UPDATED
        } else {
          return array(FALSE, validation_errors()); // UPDATE FAILS
        }
      }
    }
  }
  public function update_user_password($password_info)
  {
    // Validate update:
    if ($this->form_validation->run("edit_user_password") === FALSE)
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // SUCCESS
    {
      // Generate new salt and encrypt new password:
      $salt = bin2hex(openssl_random_pseudo_bytes(22));
      $encrypted_password = md5($password_info['password'] . "" . $salt);

      // If password change is coming from admin edit page, and currently logged in user is indeed an admin, allow the user password change:
      if ($password_info['form_name'] === 'admin_edit_pass' && intval($this->get_user($this->session->userdata['user_id'])['user_level']) === 9)
      {
        $user_id = $password_info['user_id'];
      }
      else if ($password_info['form_name'] === 'edit_pass'){
        $user_id = $this->session->userdata('user_id');
      }

      // Write to database:
      $query = "UPDATE users SET password = ?, salt = ?, updated_at = ? WHERE id = ?";
      $values = array($encrypted_password, $salt, date('Y-m-d H:i:s'), $user_id);
      $result = $this->db->query($query, $values);
      if ($result) {
        return TRUE; // USER PASS UPDATED
      } else {
        return array(FALSE, validation_errors()); // UPDATE FAILS
      }
    }
  }
  public function update_user_desc($desc_info)
  {
    // See if anything has changed:
    $user = $this->get_user($this->session->userdata('user_id'));
    if ($user['description'] === $desc_info['description'])
    {
      return array(FALSE, "<p>Description has not changed.</p>");
    }
    // Validate update:
    if ($this->form_validation->run("edit_user_desc") === FALSE)
    {
      // Ship errors back to controller:
      return array(FALSE, validation_errors());
    } 
    else // SUCCESS
    {
      // Write to database:
      $query = "UPDATE users SET description = ?, updated_at = ? WHERE id = ?";
      $values = array($desc_info['description'], date('Y-m-d H:i:s'), $this->session->userdata('user_id'));
      $result = $this->db->query($query, $values);
      if ($result) {
        return TRUE; // USER PASS UPDATED
      } else {
        return array(FALSE, validation_errors()); // UPDATE FAILS
      }
    }
  }
}