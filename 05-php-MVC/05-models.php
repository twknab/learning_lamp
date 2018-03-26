<?php 
#########################
## Connecting to Your Database
#########################

/*
In order to run queries, we have to connect CI to the MySQL Server and select the database to be used. This is done by updating /application/config/database.php.
/application/config/database.php
*/

$db['default']['hostname'] = 'localhost'; 
$db['default']['username'] = 'root';
$db['default']['password'] = 'root'; //use '' if you're using WAMP
$db['default']['database'] = 'codingdojo';

#########################
## Anatomy of a Model
#########################

/* 
Model classes represent the tables in a database. When a new model class is created, it extends from the CI_Model class included in CodeIgniter. By doing so, the new model class inherits certain methods and attributes from the default CI_Model class. Let's create the Course model for codingdojo database with the code below and save it as course.php. This file will be in  application/models/course.php.  Put in the following code.
*/

class Course extends CI_Model {

  function get_all_courses() {
    return $this->db->query("SELECT * FROM courses")->result_array();
  }

  function get_course_by_id($course_id) {
    return $this->db->query("SELECT * FROM courses WHERE id = ?", array($course_id))->row_array();
  }

  function add_course($course) {
    $query = "INSERT INTO Courses (title, description, created_at) VALUES (?,?,?)";
    $values = array($course['title'], $course['description'], date("Y-m-d, H:i:s")); 
    return $this->db->query($query, $values);
  }
}

/*
Here, we have three methods defined in the model: one to retrieve all courses, one to get a course with a particular id, and one to add a course.  Some key highlights:

result_array() - this method returns all the query results in an array.  If the query has multiple rows, it returns all of those rows in a multi-dimensional array.

row_array() - this method returns the first row from the query result.

Using ? - in the query method, we use what CodeIgniter calls 'query binding' to have CodeIgniter insert the values specified in the second parameter of the query method AND also ESCAPE it properly to avoid any SQL injection. ALL of your queries should be done using this query binding.  

For example running $this->db->query("INSERT INTO courses (title, description, created_at) VALUES (?,?,?)", array('Dojo', 'Ninja', '2013-12-25')) would run the following query: "INSERT INTO courses (title, description, created_at) VALUES ('Dojo','Ninja','2013-12-25')".

What you see above (running $this->db->query with result_array(), row_array() with query binding) is all you need to know to do everything you need. If you look at the CodeIgniter's documentation, it will give you dozens of other methods you can use with your model but you don't need any of them. Just spend time getting yourself familiar with the methods we teach above.


Loading the Model in the Controller

The sample code below shows how Controllers and Models work together in order to get or add a new record in the database.
*/

class Courses extends CI_Controller {
  public function show($id) {   
    $this->output->enable_profiler(TRUE); //enables the profiler
    $this->load->model("Course"); //loads the model
    $course = $this->Course->get_course_by_id($id);  //calls the get_course_by_id method
    var_dump($course);
  }
      
  public function add() {
    $this->load->model("Course");
    $course_details = array(
        "title" => "JavaScript",
        "description" => "JavaScript Rocks!"
    ); 
    $add_course = $this->Course->add_course($course_details);
    if($add_course === TRUE) {
        echo "Course is added!";
    }
  }

}

#########################
## Highlights
#########################
/*
    Loading the model - We used '$this->load->model('Course')' to load the model Course in the Controller.

    Calling a method in the model - To call a function from the loaded model we used $this->Model_name->function_name(parameter);

    Enable Profiler (IMPORTANT) - CodeIgniter has a Profiler Class that can display queries that are run, SESSION/POST data as well as other useful information that makes debugging/troubleshooting much easier. We strongly recommend that you use this throughout your assignments. For more information, you may check this CodeIgniter documentation.

For the create method, we passed a pre-defined array to the model. Although, in a real web application, your method in the Controller will most likely pass the POST data to the model, set some values into Sessions if needed, etc.
*/

#########################
## Other Important Information
#########################
/*
MODELS and POST/SESSION - Models should not directly access POST or SESSION data although the controller can pass POST or SESSION data for the models to access.  Again, the model's job is not to manipulate POST or SESSION (that's the controller's job) but merely to do the job necessary for updating the database or for retrieving proper information from the database.

The Singular name for the models - Models are usually named Singular while the Controllers are named Plural. Please use this convention without having to name your controller, say Controller_User and your model Model_User. Instead, name your controller 'Users' and name your model 'User'. This is a good convention and what most developers do.

Have 'database' in your library autoloader - If you don't have the database library in your autoloader, you won't have access to any of the db->query methods. Make sure you automatically load this library, especially if you've migrated to CodeIgniter 3. Check below for an example:
*/

$autoload['libraries'] = array('database', 'session');

?>