<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
    $data = array();

    // If number not in session, generate it:
    if (!$this->session->userdata('number')) {
      $number = rand(1, 100);
      $data["number"] = $number;
      $this->session->set_userdata('number', $number);
    } else {
      $data["number"] = $this->session->userdata('number');
    }
    // If guess, store it:
    if ($this->session->userdata('guess')) {
      $data["guess"] = $this->session->userdata('guess');
    }

    // If any errors:
    if ($this->session->flashdata('error')) {
      $data["error"] = $this->session->flashdata('error');
    }

		$this->load->view('main', $data);
	}
	public function guess()
	{
    $this->load->library("form_validation");
    $this->form_validation->set_rules("guess", "Guess", "min_length[1]|required|trim|max_length[3]|less_than[101]|greater_than[0]");
    if($this->form_validation->run() === FALSE)
    {
      $this->session->set_flashdata('error', validation_errors());
    }
    else
    {
      $guess = $this->input->post('guess', TRUE);
      $guess = (int)$guess;
      $this->session->set_userdata('guess', $guess);
    }
    redirect('/');
	}
	public function reset()
	{
    $this->session->unset_userdata('number');
    $this->session->unset_userdata('guess');
    redirect('/');
	}
}
