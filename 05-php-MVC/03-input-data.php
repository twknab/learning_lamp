<?php 

####################
## USER INPUT & XSS FILTERING
####################

// Normally so far using PHP we've use $_POST to grab post data. This is great and all, but Codeigniter has some "cross script attack" sanitization that we can apply to post forms.

// This has to be enabled in config by looking for:

$config['global_xss_filtering'] = TRUE;
// by default this is set to FALSE. Must be set to TRUE to enable it.

/*
Once global_xss_filtering is turned on, we no longer access our post/or get data via $_POST or $_GET, but instead use:
*/

// instead of `$_POST['something']`, we access:
$something = $this->input->post('something', TRUE);
// to get the POST value
// passing TRUE passes the data through the XSS filter
// if the value does not exist, FALSE is returned
// we would use `get` rather than `post`, etc.

// To return an array of all POST items call without any parameters.

// To return all POST items and pass them through the XSS filter set the first parameter NULL while setting the second parameter to boolean;

// The function returns FALSE (boolean) if there are no items in the POST.

$this->input->post(NULL, TRUE); // returns all POST items with XSS filter 
$this->input->post(); // returns all POST items without XSS filter

####################
## GLOBAL VARIABLES
####################
/*
 To learn more about using the Input Class, let's work with forms and data submission. Let's create a view with the code below and save it in application/views/add_course_page.php.

<!DOCTYPE html>
<html>
<head>
 <title>Using XSS Filtering</title>
</head>
<body>
 <form action="/courses/add_course" method="post">
  <input type="text" name="title" placeholder="email">
  <input type="text" name="description" placeholder="description">
  <input type="submit" value="Add course">
 </form>
</body>
</html>

Compared to basic PHP where the action of a form is usually a file (action="login.php" etc), remember that in MVC Controllers are directly related to the URL. That is why (action="/courses/add_course") would mean that we are going to submit the form into a Controller named as Courses with function add_course() inside it.

class Courses extends CI_Controller {
    //displays the add course page
    public function index()
    {
        $this->load->view('add_course_page');
    }
    //processes the adding of a course
    public function add_course()
    {
        $course_details['title'] = $this->input->post('title'); 
        $course_details['description'] = $this->input->post('description');
        $this->load->model("Course_model");
        $add_course = $this->Course_model->add_course($course_details);
        if($add_course){
            echo "Course is added";
        }
    }
}

####################
## GLOBAL VARIABLES
####################

The Input Class can also be used to handle other global variables. If you are overwhelmed about these Global Variables, please go back and review the PHP course where it was discussed.

//$_GET 
$this->input->get();
//$_COOKIE 
$this->input->cookie();
//$_SERVER
$this->input->server();

*/

?>