<?php 

/*
#########################
## Other Key Lessons
#########################

  Role of Routing - each URL request goes to index.php and is handed to the routing file. Routing file determines which controller/method should handle the URL request.

  !!! VERY IMPORTANT !!! 
  Method in the Controller - A method in the controller that handles the POST data should NOT render the view file. Although this is possible to do in CodeIgniter, it's strongly discouraged. Instead, have that method redirect to another URL, which is handled by a separate method that does render the view. For example if a form is submitted, say you submit to 'ninjas/form' which handles the POST data, sets SESSION data, and redirect to say 'ninjas/success' which is handled by success method in the ninjas controller that renders the view file.  Do NOT have the form method process POST, set SESSION and also render the view file (when the user reloads the page it submits the form each time which is not what you want to happen).
  
  Role of the Model - The model should NOT access POST or modify POST data directly.  You can have the controller pass some or all of POST data to the model but in the model you should never directly access POST or SESSION data. Have the controller deal with SESSION data and not the model.
  What redirect does - redirecting to another URL starts a new HTTP request, which means that new HTTP request is sent to index.php, routing file, controller and so forth. Using redirect in the controller does NOT automatically call the method in that controller, it just starts a new URL request.


*/

?>