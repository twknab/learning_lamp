<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_model extends CI_Model
{
  public function get_all_courses()
  {
    return $this->db->query("SELECT * FROM courses ORDER BY created_at DESC")->result_array();
  }
  public function get_course($course_id)
  {
    return $this->db->query("SELECT * FROM courses WHERE id = ?", array($course_id))->row_array();
  }
  public function delete_course($course_id)
  {
    $result = $this->db->query("DELETE FROM courses WHERE id = ?", array($course_id));
    if ($result) {
      return true;
    } else {
      return false;
    }
  }
  public function add_course($course)
  {
    // Load validation library:
    $this->load->library("form_validation");
    if ($this->form_validation->run() === false) {
      // Store errors and ship back to controller:
      return array(false, validation_errors());
    } else {
      // Write to database:
      $query = "INSERT INTO courses (name, description, created_at, updated_at) VALUES (?,?,?,?)";
      $values = array($course['name'], $course['description'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s'));
      return $this->db->query($query, $values);
    }
  }
}
