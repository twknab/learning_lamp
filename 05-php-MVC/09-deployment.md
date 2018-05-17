# Step 1:
Create AWS EC2 Ubuntu Instance with correct security permissions and valid PEM key.

# Step 2:
Setup Apache2 and your EC2 Instance for LAMP Stack:

## Install

Remember when we had to install a bunch of stuff to set up our development environment for our own computers? We have to do the same for this EC2 instance. It only has some basic programs installed. We need to download our LAMP (Linux-Apache-MySQL-PHP) stack. We already have Ubuntu installed, the operating system we chose when we launched our instance, which is a flavor of Linux. We will also have to download Apache which is a web server that will serve responses to our users' requests. We also have to download MySQL for database storage. Oh yeah! And we have to download PHP to complete our LAMP stack.

Thankfully, there is a single command that will install all the necessary programs for our basic LAMP stack. There are so many programs that no one can remember all of them. However, make sure you look at the terminal and see what kinds of programs are being installed. We will also go over the command to uninstall the LAMP stack and we can see from that command what programs were installed for us.

Note: Make sure you are logged in to your ubuntu computer (terminal for Mac, GitBash or PuTTy for Windows)
Install

First, let's make sure all of our packages are up to date by running this command:

`sudo apt-get update && sudo apt-get upgrade`

Now run this command to install the LAMP stack:

`sudo apt-get install lamp-server^`

The command will download a bunch of programs and as it is installing MySQL it will ask you to set a password. This will be a bright pink output.  You are going to need a password to interact with your MySQL server in this EC2 instance so do not forget this. We recommend setting it to root. Once all of the programs are done downloading, scroll up and see familiar words such as Apache, MySQL, and PHP. 

Let's install Git as well.  Run the following command to install git:

`sudo apt-get install git`

This will install git onto our server, which we will use in the next tab.

Congratulations! Your EC2 instance is now a developing machine! Go ahead and navigate to the Public DNS or Public IP of your EC2 instance in your browser.  You can find the Public DNS or Public IP in the details of your instance on the AWS Console.

How cool is that? You are now officially a Full Stack developer. Now we don't want our users to see this default page that our server is displaying. Where could this file be? Go ahead and type pwd in your terminal. This will show where you are in the file structure of the computer. It stands for path working directory.

`pwd`

We want to be in the root directory so we will change our directory to '/' with this command:

`cd /`

Now, let's type pwd again to make sure that we are indeed in the '/' directory. Now let's see what is stored in the root directory by using the ls command to list out all the directories and files located in '/.'

`ls`

We want to go inside the 'var' directory. We can change directory to 'var' by running this command:

`cd var`

Let's see what is inside this directory by using our 'ls' command again. You will find a directory called 'www.' This looks promising. Let's change our directory into 'www.'

`cd www`

When we use the 'ls' command to see what is inside the 'www' directory, we will find that there is a directory in there named 'html.' We are very close. Now let's change our directory to 'html' by running this command:

`cd html`

If we type 'ls' again, we'll find index.html! We only know where to find this file because this is the location where the HTML files are stored in most Ubuntu servers. Now how do we open this file? We won't be able to use Sublime Text. We are going to have to use one of the text editors that are already installed in this Ubuntu computers. Our two main choices will be vi and nano. We will be using vi in this tutorial. Type in this command to open index.html with vi:

`sudo vi index.html`

Notice how we prefixed our command with 'sudo' again. This is because we want to save this file and for us to write to a file we need to let the computer know that we are the superuser. Press Ctrl-D to quickly scan the file. This is just the HTML and CSS of the default Ubuntu page we saw when we navigated to our Public DNS or Public IP. Now let's go back to the terminal by quitting vi. You can quit vi by running this command:

`:q`

If you had made any changes and you want to quit without making any changes you would run this command:

`:q!`

We are only going to cover the basic commands in vi for us to launch our application. Now let's remove this index.html file so that we can just make one ourselves. You can do this by running this command in the terminal:

`rm index.html`

You will get an error that says 'Permission Denied.' You have to let the computer know that you are the superuser and you want this to happen. Go ahead and prefix the previous command with'sudo':

`sudo rm index.html`

Go ahead and type 'ls' to ensure that the file has been deleted. We can open up a new file called 'index.html' (if the file called 'index.html' already exists it would open up that file) using vi by running this command:

`vi index.html`

If you have tried typing on this file, you will have heard a bunch of beeps signifying an error. This is because you are not in Insert Mode. vi is known for having different modes and the default mode is Normal. To enter insert mode, press 'i.' On the bottom of the terminal screen, you should see the word INSERT in bold notifying that you have now entered insert mode. If you want to navigate to a different part of the file and insert, you must first exit insert mode by pressing the ESC key. Then, go to the area you want to edit and enter insert mode again by pressing 'i.' vi is one of the hardest text editors to master so feel free to type out your HTML on your Sublime Text locally then copy it and paste it into vi while you are on insert mode. Go ahead and type out basic HTML that says something like, "I am now Full Stack." You can save the file by running this command while you are in Normal mode:

`:w`

Or you can use this command which will save and quit vi.

`:wq`

Now navigate to your Public DNS or Public IP in your browser to see the changes that you made. You should be able to see the changes almost immediately but in some cases it might take longer. Congratulations, you have deployed your first application on the cloud!


# Step 3:

Create GitHub repo, and push your project to it.


# Step 4:

Create an .HTACCESS file:

After you have deployed your blank CodeIgniter application, go ahead and create a .htaccess with these contents. This file will allow you to not have 'index.php' appended to all of your URLs. The .htaccess should have the following text:

```
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    #Removes access to the system folder by users.
    #Additionally this will allow you to create a System.php controller,
    #previously this would not have been possible.
    #'system' can be replaced if you have renamed your system folder.
    RewriteCond %{REQUEST_URI} ^system.*
    RewriteRule ^(.*)$ /index.php?/$1 [L]
    #When your application folder isn't in the system folder
    #This snippet prevents user access to the application folder
    #Submitted by: Fabdrol
    #Rename 'application' to your applications folder name.
    RewriteCond %{REQUEST_URI} ^application.*
    RewriteRule ^(.*)$ /index.php?/$1 [L]
    #Checks to see if the user is attempting to access a valid file,
    #such as an image or css document, if this isn't true it sends the
    #request to index.php
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?/$1 [L]
</IfModule>
<IfModule !mod_rewrite.c>
    # If we don't have mod_rewrite installed, all 404's
    # can be sent to index.php, and everything works as normal.
    # Submitted by: ElliotHaughin
    ErrorDocument 404 /index.php
</IfModule>
```
`

After we have included this .htaccess file, there are three things that we need to do to get .htaccess to work on our website so that our routes look pretty. First, navigate to your /application/config/config.php of your CodeIgniter project and make sure that the $config['index_page'] is equal to "":

`$config['index_page'] = "";`

Second, our .htaccess needs the rewrite library enabled on our computer to work. We can enable this module by running the following command:

`sudo a2enmod rewrite`

NOTE: Make sure you restart your server after making any modifications.

`sudo service apache2 restart`

Third, we have to configure our Apache so that it allows rewriting of the URLs. Let's navigate to /etc/apache2 by running the following command:

`cd /etc/apache2`

If you type in 'ls' you will see a file called 'apache2.conf.' This is the file where we allow .htaccess. Let's open this file to modify with vi using the following command:

`sudo vi apache2.conf`

This is a large file so let's search for the part of the file where it says something with 'root.' We can do this in vi by running this command while you are in normal mode.

`/root`

Then go down a few more lines until you see something like this

```
<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride None
    Require all granted
</Directory>
```

Change it to this:

```
<Directory /var/www/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Then restart your apache2 server and your .htaccess will now work.