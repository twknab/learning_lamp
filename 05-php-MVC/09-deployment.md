# Step 1:
Create AWS EC2 Ubuntu Instance with correct security permissions and valid PEM key.

# Step 2:
Setup Apache2 and your EC2 Instance for LAMP Stack:

## Install


Installing Apache, PHP, and MySQL

Now that we have a server running in the cloud, we need to install the pieces of the LAMP stack on it. To do this, you will need to open a Secure Shell on your EC2 instance.

Once again, this is a super-fast review to get you setup for your exam. If you need to review how to do this, or need further details, checkout section  IIA (for Mac) or IIB (for PC) and section III of the Deployment chapter.

### Install the lamp-server package

On your EC2 terminal, execute the following to ensure that apt-get is up-to-date:

sudo apt-get update && sudo apt-get upgrade

Now, install the LAMP stack:

`sudo apt-get install lamp-server^`

You will get a PINK screen that will ask you to set the password for the root user in MySQL, but other than that, it should all install without interaction.

### Verify your installation

On your AWS EC2 console, copy the Public DNS or IP Address:

Now open a new browser window and paste it into the URL field, then hit Enter.

If everything installed correctly, you will see this:

### Configure Apache

Now we need to enable URL rewriting and our .htaccess file.

From your EC2 terminal, run the following command:

`sudo a2enmod rewrite`

Next, we have to configure Apache so that it allows rewriting of the URLs.

Navigate to  /etc/apache2 by running the following command:

`cd /etc/apache2`

Followed by:

`sudo vi apache2.conf`

This will open the vi text editor.

Search for the section we want by typing:

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

Now save the file and quit by hitting the ESC key, then typing:

`:wq`

This will save the file.

Next, we will want to change Apache's document root.

Type:

`cd /etc/apache2/sites-enabled`

then:

`sudo vi 000-default.conf`

Once vi opens on the file, scroll down until you see:

`DocumentRoot /var/www/html`

change this to:

`DocumentRoot /var/www/html/LAMPBeltPrep`

then hit ESC and save by typing:

`:wq`

That last bit sets Apache's document root to the LAMPBeltPrep folder, which does not exist, but will once you clone your Git repository onto your EC2 instance in the next section.

Make sure you restart your server whenever making any configuration modifications.

Finally, execute this last command:

`sudo service apache2 restart`

### Configure MySQL

The last thing we want to do here is set MySQL to run on port 8889 just like we do locally.

In your EC2 terminal, navigate to your MySQL configuration file, and edit it:

`cd /etc/mysql`
`sudo vi my.cnf`

Find the [mysqld] section, and change the port entry from 3306 to 8889:

Hit ESC (to exit INSERT mode) then save it with:

`:wq`

Now, restart MySQL with:

`sudo service mysql restart`

When it comes back up, you can verify the new port by executing:

`netstat -tln`

and looking for the line containing 127.0.0.1:8889.

That's it! Your cloud server is all setup and ready to go!



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

# Step 5:


## Point MySQL Workbench at Your DB Instance

Now that we have our LAMP stack up and running in the cloud, we need to connect your MySQL Workbench to it.

** There are several options for you to communicate with your EC2-hosted DB, but this is quick, easy, and familiar.
### Create a New Connection

Open MySQL Workbench and click the Create New Connection button:

This will open the New Connection panel.  Fill it in as follows:

    Connection Name = AWS
    Connection Method = Standard TCP/IP over SSH
    SSH Hostname = Get this from your EC2 console. Copy the Public DNS name (found just below the list of instances, at the top-right of the panel), and paste it here
    SSH Key File = Click the "..." button and navigate to your PEM file that you downloaded when you created your EC2 instance
    MySQL Server Port = 8889
    Password = Click the Store in Keychain ... button and enter the password for your DB's root user (this is typically 'root')
    Everything else should default to the proper values, but if they do not match the image, change them so they do

### Test the Connection

Finally, hit the  Test Connection button, and you should see a "Success" message. If so, click the OK button to create the connection.

### Connect

Now, when you click this connection, you will be attached to MySQL running on your EC2 instance, which means you can easily create or copy tables for your deployed application!

Next we will setup Git so we can keep track of our work, and deploy it easily to our EC2 instance.
