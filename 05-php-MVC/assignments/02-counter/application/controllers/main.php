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
    if ($this->session->userdata('counter')) {
      $counter = $this->session->userdata('counter');
      $this->session->set_userdata('counter', $counter + 1);
    } else {
      $this->session->set_userdata('counter', 1);
    }

		$this->load->view('main', array("count" => $this->session->userdata('counter')));
	}
	public function reset()
	{
    $this->session->set_userdata('counter', 0);
    redirect('/');
	}
}
