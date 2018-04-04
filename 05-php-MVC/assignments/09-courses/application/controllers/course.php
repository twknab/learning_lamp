<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends CI_Controller {
	public function index()
	{
    // Turn on Profiler:
    $this->output->enable_profiler(TRUE);

    // Load Index Page:
    $this->load->view("main");
  }
	public function add()
	{
    // XSS filter any post data before sending to model:
    $course = $this->input->post(NULL, TRUE);
    if ($course) {

      // SEND TO MODEL FOR VALIDATION AND CREATION

      var_dump($course);
    } else {
      redirect("/");
    }
  } 
	public function confirm_delete($course)
	{
    // Load Confirm Delete Page:
    $this->load->view("confirm_delete");
  }
	public function delete($course)
	{
    // SEND TO MODEL FOR DELETION
  }
}
