<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function index()
	{
    /*
    Loads index and retrieves current log and gold.
    */

    // if user's first time create activity log and set gold to 0:
    if (!$this->session->userdata("activity"))
    {
      $this->session->set_userdata("activity", "👋 No activity yet. Get some gold! " . $this->__getDate());
      $this->session->set_userdata("gold", 0);
    }
    
    // retrieve activity log and gold:
    $data["activity"] = $this->session->userdata("activity");
    $data["gold"] = $this->session->userdata("gold");

    // load homepage with data attached:
    $this->load->view('main', $data);
  }
	public function process_money()
	{
    /*
    Processes monies based on place.
    */

    // Get post data using XSS filtering:
    $post_form = $this->input->post(NULL, TRUE);

    if ($post_form) {
      switch ($post_form["building"]) 
      {
        case "farm":
          // Add gold to user gold:
          $gold =  $this->__get_gold(10, 20);
          // Update gold:
          $this->__update_gold("farm", $gold);
          // Redirect to index:
          redirect('/');
        case "cave":
          // Add gold to user gold:
          $gold =  $this->__get_gold(5, 10);
          // Update gold:
          $this->__update_gold("cave", $gold);
          // Redirect to index:
          redirect('/');
        case "house":
          // Add gold to user gold:
          $gold =  $this->__get_gold(2, 5);
          // Update gold:
          $this->__update_gold("house", $gold);
          // Redirect to index:
          redirect('/');
        case "casino":
          $gold = $this->__get_gold(0, 50);
          // See if user wins or loses:
          // Note, a 0 means a win, a 1 means a loss:
          $outcome = rand(0,1);
          // If user wins add gold to total and update log:
          if ($outcome === 0) 
          {
            // Add gold to existing gold (win!):
            $this->__update_gold("casino", $gold);

          } 
          // If user loses, subtract gold from total and update log:
          else 
          {
            // Add gold to existing gold (win!):
            $this->__update_gold("casino", $gold, TRUE);
          }
          // Redirect to index:
          redirect('/');
      }
    }
  
  }
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
  // $$$$$$$$   HELPER METHODS   $$$$$$$$
  // $$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

  private function __get_gold($min, $max)
  {
    /*
    Gets gold based on a min and max
    */
    return rand($min, $max);
  }

  private function __getDate()
  {
    /*
    Returns formatted current date
    */
    return date("(Y/m/d g:i:s a)");
  }

  private function __update_gold($name, $gold, $subtract=FALSE)
  {
    /*
    Updates gold value.

    Note: if $subtract = TRUE, the value will be SUBTRACTED.
    By default, subtract is FALSE (things will be ADDED by default)
    */

    if (!$subtract) 
    {
      // Add new gold value to gold in session:
      $this->session->set_userdata("gold", $this->session->userdata("gold") + $gold);
      // Update log:
      $this->__update_log($name, $gold);
    } 
    else 
    {
      // Get existing gold:
      $existing_gold = $this->session->userdata("gold");
      // If gold being taken is greater than existing, AND subtract is TRUE (VERY IMPORTANT): 
      if ($gold > $existing_gold) 
      {
        // Set user's gold to 0:
        $this->session->set_userdata("gold", 0);

        // Update activty log message:
        $this->__update_log($name, $gold, TRUE);

        // Add message to activity about being Broke:
        $this->session->set_userdata("activity", "😣 You just lost all your gold! " . $this->__getDate() . "<br/>" . $this->session->userdata("activity"));
      } 
      else
      {
        // Subtract new gold value to gold in session:
        $this->session->set_userdata("gold", $this->session->userdata("gold") - $gold);
        $this->__update_log($name, $gold, TRUE);
      } 
    }

    return $this;
  }

  private function __update_log($name, $gold, $subtract=FALSE)
  {
    /*
    Updates log.

    Note: if $subtract = TRUE, the LOST message will be appended to log.
    By default, subtract is FALSE (EARNED message will be appended by default)
    */
    if (!$subtract)
    {
      // Update log earning new value. Note: we concateonate and the existing log to the END of our new string, so that our newest entry remains on TOP (most recent) of the activity feed:
      $activity =  "💰 Earned " . $gold . " from the " . $name . "! " . $this->__getDate() . "<br/>" . $this->session->userdata("activity");
    }
    else 
    {
      // Update log stating that the value is being REMOVED on log:
      $activity =  "💸 Lost " . $gold . " from the " . $name . "! Ouch...Sorry! " . $this->__getDate() . "<br/>" . $this->session->userdata("activity");
    }

    // Set updated activity feed to session:
    $this->session->set_userdata("activity", $activity);

    return $this;
  }
}
