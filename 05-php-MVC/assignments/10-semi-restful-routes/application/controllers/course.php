<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Course extends CI_Controller {
  public function index()
	{
    // Create empty array for data:
    $data = array();

    // Retrieve any flash errors:
    if ($this->session->flashdata('errors')) {
      $data["errors"] = $this->session->flashdata('errors');
    }

    // Load the model:
    $this->load->model("Course_model");

    // Get all courses:
    $courses = $this->Course_model->get_all_courses();

    $data["courses"] = $courses;

    // Load Index Page:
    $this->load->view("main", $data);
  }
	public function add()
	{
    // Turn on Profiler:
    $this->output->enable_profiler(TRUE);
    // Load the model:
    $this->load->model("Course_model");
    // XSS filter any post data before sending to model:
    $course = $this->input->post(NULL, TRUE);

    if ($course) {

      // Call model to try and create new course:
      $new_course = $this->Course_model->add_course($course);

      if ($new_course[0] === FALSE) 
      {
        // Save errors to flash session:
        $this->session->set_flashdata('errors', $new_course[1]);
        redirect("/");
      }
      else {
        redirect("/");
      }

    } else {
      $this->session->set_flashdata('errors', "A server error occurred. Please contact administrator.");
      redirect("/");
    }
  } 
	public function confirm_delete($course_id)
	{
    $data["course_id"] = $course_id;
    $this->load->model("Course_model");
    $data["course"] = $this->Course_model->get_course($course_id);
    if (!$data["course"])
    {
      $this->session->set_flashdata("errors", "Could not get course. Please contact administrator.");
      redirect("/");
    }
    // Load Confirm Delete Page:
    $this->load->view("confirm_delete", $data);
  }
	public function delete($course_id)
	{
    $this->load->model("Course_model");
    // Send to model for deletion:
    $result = $this->Course_model->delete_course($course_id);
    if (!$result) 
    {
      $this->session->set_flashdata("errors", "Course could not be deleted. Please contact administrator.");
    }
    redirect("/");
  }
}
