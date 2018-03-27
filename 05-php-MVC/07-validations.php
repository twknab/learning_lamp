<?php 

// Instead of doing all our validations manually like we did before,
// CodeIgniter  has a form_validation library that we can tap into: 
$this->load->library("form_validation");
$this->form_validation->set_rules("first_name", "First Name", "trim|required");
if($this->form_validation->run() === FALSE)
{
     //$this->view_data["errors"] = validation_errors();
}
else
{
     //codes to run on success validation here
}


// Note how the function set_rules() of the Form Validation class takes 3 parameters, the name of the input field to be validated, a label for the error mesåsage, and finally the validation rules for that particular field.

$this->form_validation->set_rules("first_name", "First Name", "trim|required");

// first_name field of our input form is required and it gets trimmed

// this will run our validation, and will return FALSE if errors and place them inside of the function `validation_errors()`:
// $this->form_validation->run()

// See this page for more validation info:
// https://www.codeigniter.com/userguide3/libraries/form_validation.html#rule-reference



?>