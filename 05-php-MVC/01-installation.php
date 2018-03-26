<?php 
/*
Download the codeigniter files here: 

http://s3.amazonaws.com/General_V88/boomyeah/company_209/chapter_3063/handouts/chapter3063_7612_CI3WithHTAccess.zip



 For each project you create using CodeIgniter, you will copy these files into a new project folder. For instance, if you're building a project called The Wall, and the project folder is called the_wall_2.0, ALL the CodeIgniter files will go inside. This will include the application and system folders, .htaccess, and any extra files or documentation.


## Directory Structure

    application folder - Contains the application you're building. This folder contains models, views, and controllers, which are in essence your main code of your web app.
    system/ folder - The system folder has the default files/classes that are invoked every time CodeIgniter runs. Never edit files in this directory.
    index.php - Initialize/loads resources needed to run CodeIgniter (Application and System files).
    assets folder - The assets folder is where all static files (CSS, Images, and JavaScript) will be located.
    .htaccess file - A configuration file to hide "index.php" in the URL, making the URL more user friendly.

## Installing Config Files
##application/config/config.php

config.php is where we manipulate the basic configuration settings of our application. Find the following $config lines and make the changes below:

// disable query strings by setting it to FALSE 
$config['enable_query_strings'] = FALSE;
// give your CodeIgniter an encryption salt
$config['encryption_key'] = '(00|_3n(rYp+!0n_k3Y';
// turn off session expiration during development
$config['sess_expiration'] = 0;
// set base URL to DEVELOPMENT server -- note this needs to be changed for deployment
$config['base_url'] = 'http://localhost:8888/';
// Remove index page:
$config['index_page'] = '';

## application/config/autoload.php

By manipulating autoload.php, we can bring in libraries and helpers automatically, without having to require them multiple times throughout our application. Make the following changes:

// make sure you load the database and session libraries automatically
$autoload['libraries'] = array('database', 'session');
// autoload the URL helper as well
// URL will be helpful later when we deal with redirects
$autoload['helper'] = array('url');

## application/config/database.php

Now let's make sure CodeIgniter can properly connect to our database. Important: This will change for every project you build, as you'll be connecting to different databases.

First thing's first, check the username of your SQL server. This defaults as root, and you can check it in your MySQL Workbench.

If your username is anything other than root, put that as your username. The hostname will ALWAYS be localhost, no matter what you named your connection in the MySQL workbench. Password will default be root for Mac users and PC users will have the default of an empty string, or blank. Finally, the database will be the name of the schema you are using for your project.

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
// default password is root for Mac and an empty string ('') for PCs
$db['default']['password'] = 'root';
// this will be your schema name
$db['default']['database'] = 'sakila_full';
$db['default']['dbdriver'] = 'mysqli';

Reminders

    Files. There are a lot of other CI files such as libraries and helpers but don't overwhelm yourself. Keep your main focus on learning how routing, controllers, views, and models work.. As you feel more comfortable with these fundamental concepts, you can start using other libraries available within CodeIgniter but initially these libraries/helpers can be more overwhelming than helpful. Also be sure to never delete files! Do not delete anything unless you are 100% sure that it's extraneous. Deleting something that's important can lead to extremely difficult-to-debug errors!
    MVC is OOP. Keep in mind that Controllers and Models are just Classes just like in OOP. Controllers are directly related to the URL request while models are directly related to the database.
    Focus. CodeIgniter comes with a great user guide http://www.codeigniter.com/user_guide/. This resource is helpful but again you only need to know about 10-15% of the materials there. The other 85-90% of stuff in that documentation are not really necessary and often times are not needed at all. We tried to compile ALL the information you need to know to build practically any web app you can think of. Master these concepts first and for other things that you don't know how to do, you can look up in the user guide. For all of the assignments in our course, you should be able to build them with just what we teach you in this chapter.
*/

?>