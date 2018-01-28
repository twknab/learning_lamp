<?php

// PHP is a server side language that can convert things into HTML/CSS/JS for consumption from web clients.

// Go ahead and run apache (download the program MAMP and run the application), and run this file to see the output:

echo "something here";
echo phpinfo();

// Note: Look in your mamp preferences, and change your document root to your primary parent folder for all of your projects. (This is what will be loaded when you run your apache server and navigate to http://localhost:8888)

// Be sure after running your MAMP server, to connect to `http://localhost:8888` and read the phpinfo (will tell you your php version and where your default configuration files are kept, etc).

// Once you receive the "phpinfo", look at the "Loaded Configuration File" path. Navigate there in Finder or Explorer.

// Open the `php.ini` file and for `html_errors` and `display_errors` turn to `On`.

// Uncomment (remove the `;`) from `xdebug` (zend_extension)

?>
