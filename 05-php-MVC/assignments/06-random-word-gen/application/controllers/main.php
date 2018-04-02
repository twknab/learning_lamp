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

    if (!$this->session->userdata("attempt_count")) {
      $random_word = $this->__generateRandomWord();
      $this->session->set_userdata("random_word", $random_word);
      $this->session->set_userdata("attempt_count", 1);
    }

    $data["random_word"] = $this->session->userdata("random_word");
    $data["attempt_count"] = $this->session->userdata("attempt_count");

		$this->load->view('main', $data);
  }
  public function generate()
  {
    // Generate random number, update session and store:
    $random_word = $this->__generateRandomWord();
    $this->session->set_userdata("random_word", $random_word);
    $data["random_word"] = $this->session->userdata("random_word");

    // Increase attempt counter:
    $attempt_count = $this->session->userdata("attempt_count") + 1;
    $this->session->set_userdata("attempt_count", $attempt_count);

    redirect("/"); // redirect to index route
  }
  private function __generateRandomWord($length = 14) {
    $char = "0123456789ABCEDEFGHIJKLMNOPQRSTUVWXYZ";
    $char_length = strlen($char);
    $random_string = "";
    for ($i = 0; $i < $length; $i++) {
      $random_string .= $char[rand(0, $char_length-1)];
    }
    return $random_string;
  }
}
