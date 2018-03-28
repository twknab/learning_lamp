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
		$this->load->view('main');
	}
	public function survey()
	{
    // If counter, increment it:
    if ($this->session->userdata('counter')) 
    {
      $counter = $this->session->userdata('counter') + 1;
      $this->session->set_userdata('counter', $counter);
    } 
    
    else  // otherwise set counter to 1
    {
      $this->session->set_userdata('counter', 1);
    }

    // Get survey post data with xss filtering
    $survey = $this->input->post(NULL, TRUE);
    // Set survey as session data:
    $this->session->set_userdata('survey', $survey);

    // do some validations??

    // redirect to result
		redirect('/main/result');
	}
	public function result()
	{
    // Get survey session data:
    $data["survey"] = $this->session->userdata('survey');
    // Get count session data:
    $data["count"] = $this->session->userdata('counter');
    // Send view with data:
    $this->load->view('result', $data);
	}
}
