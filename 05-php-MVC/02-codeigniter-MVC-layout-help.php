<?php 

/*

#############
## MVC ARCHITECTURE/LAYOUT
#############


The MVC architecture layout in Codeigniter is similar to how you've worked in Django or Angular/Node in the past, but it's a little different and understanding the nuances is important.

// The first thing to understand is the `/config/routes.php`:

  + This is where our routes live.
  + There are a few "reserved" routes for Codeigniter only.
  + $route['default_controller'] tells CI what controller to run on default.
  + route patterns are deciphered as: `localhost/class/function/ID`
    - Where 'class' is name of class within controller.
    - Where 'function' is the function within the chosen class.
    - Where 'ID' is any parameter that is passed along
  + Any calls to `view('foo')` will load `views/foo.php`

  For example: 
  - $route['my_personal_website'] in config/routes.php
  - in controllers/xyz.php will look for class called `my_personal_website` and will run.
  - inside of this class, any calls to view will load said file in `/views`


#############
## PASS DATA TO VIEW
#############

  NOTE: You can also pass associated arrays to your VIEW just like you did in Django, in the same method! Attach an associated array into the view call, e.g, "view('coolpage', $my_data)"

  where $my_date = ('something'=>'some value', 'something_else'=>'another_thing');

  Now in view, we can access:  <?='something'?> or  <?='something_else'?>

  It's actually best practices to send a two-dimensional array such as:

  $view_data["data"] = (
    "something"=>"here",
    "else"=>"here
  )

  Now we can do <?=data['something']?>

#############
## INCLUDE WITHIN VIEW FILES
#############

  We can also include data in our view from other files, such as:

  <?php $this->load->view('partials/header') ?>
    <h1>Ninjas</h1>
    <p>This view file is in /application/views/dojo/ninjas.php</p>
  <?php $this->load->view('partials/footer') ?>

#############
## REDIRECT
#############

Another tool we have at our disposal is the redirect() function. Redirect() merely redirects the header to the URL we pass to it. A full URL to a separate website will act a lot like this->load->view, check out the example below:

if ($go_to_google == TRUE)
{
    redirect("http://www.google.com");
}

Besides hard linking, we can use the redirect() to call methods within our controllers. If you need to call one controller method from within another controller method, use redirect()! Do not directly call public methods within your controller, always use redirect() for this! 

Consider the below example:

public function index()
{
    $get_data['data'] = $this->Data->getData();
    $this->load->view('index', $get_data);
}

public function logout()
{
    $this->session->sess_destroy();
    $this->session->set_flashdata('error_message', "Logged Out successfully");
    redirect('/');
}



*/

?>