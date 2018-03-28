<?php 
/*
Session also works differently in CodeIgniter:  instead of using `$_SESSION` as we did before, we use codeigniters capabilities. Some of which even includes encrypting our session data, or even "flash data", for one-time use session data which can be used to display error messages.

#########################
## How do Sessions Work?
#########################

When a page is loaded, the session class will check to see if valid session data exists in the user's session cookie. If sessions data does not exist (or if it has expired) a new session will be created and saved in the cookie. If a session does exist, its information will be updated and the cookie will be updated. With each update, the session_id will be regenerated.

It's important for you to understand that once initialized, the Session class runs automatically. There is nothing you need to do to cause the above behavior to happen. You can, as you'll see below, work with session data or even add your own data to a user's session, but the process of reading, writing, and updating a session is automatic.
What is Session Data?

A session, as far as CodeIgniter is concerned, is simply an array containing the following information:

  The user's unique Session ID (this is a statistically random string with very strong entropy, hashed with MD5 for portability, and regenerated (by default) every five minutes)
  The user's IP Address
  The user's User Agent data (the first 120 characters of the browser data string)
  The "last activity" timestamp.
  The above data is stored in a cookie as a serialized array with this prototype:
*/

array
(
  'session_id'    => null, // andom hash,
  'ip_address'    => 'string - user IP address',
  'user_agent'    => 'string - user agent data',
  'last_activity' => null, // timestamp
);

/*

#########################
## Retrieving Session Data
#########################

Any piece of information from the session array is available using the following function:
*/

$this->session->userdata('item');

/*
Where item is the array index corresponding to the item you wish to fetch. For example, to fetch the session ID you will do this:
*/

$session_id = $this->session->userdata('session_id');

/*
Note: The function returns FALSE (boolean) if the item you are trying to access does not exist.

#########################
## Adding Custom Session Data
#########################

A useful aspect of the session array is that you can add your own data to it and it will be stored in the user's cookie. Why would you want to do this? Here's one example:

Let's say a user logs into your site. Once authenticated, you could add their username and email address to the session cookie, making that data globally available to you without having to run a database query when you need it.

To add your data to the session array involves passing an array containing your new data to this function:
*/

$this->session->set_userdata($array);

/*
Where the $array is an associative array containing your new data. Here's an example:
*/

$newdata = array(
  'username'  => 'johndoe',
  'email'     => 'johndoe@some-site.com',
  'logged_in' => TRUE
);
$this->session->set_userdata($newdata);

/*
If you want to add user data one value at a time, set_userdata() also supports this syntax.
*/

$this->session->set_userdata('some_name', 'some_value');

/*
#########################
## Retrieving All Session Data
#########################

An array of all user data can be retrieved as follows:
*/

$this->session->all_userdata();

/*
And returns an associative array like the following:

Array (
    [session_id] => 4a5a5dca22728fb0a84364eeb405b601
    [ip_address] => 127.0.0.1
    [user_agent] => Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7;
    [last_activity] => 1303142623
)
*/


/*
#########################
## Removing Session Data
#########################

Just as set_userdata() can be used to add information into a session, unset_userdata() can be used to remove it, by passing the session key. For example, if you wanted to remove 'some_name' from your session information:
*/

$this->session->unset_userdata('some_name');

// This function can also be passed an associative array of items to unset.

$array_items = array('username' => '', 'email' => '');
$this->session->unset_userdata($array_items);

/*
#########################
## Flashdata
#########################

// CodeIgniter supports "flashdata", or session data that will only be available for the next server request, and are then automatically cleared. These can be very useful, and are typically used for informational or status messages (for example: "record 2 deleted").

Note: Flash variables are prefaced with "flash_" so avoid this prefix in your own session names.

To add flashdata:
*/

$this->session->set_flashdata('item', 'value');


// You can also pass an array to set_flashdata(), in the same manner as set_userdata().

// To read a flashdata variable:

$this->session->flashdata('item');

// If you find that you need to preserve a flashdata variable through an additional request, you can do so using the keep_flashdata() function.

$this->session->keep_flashdata('item');

/*
#########################
## Helpful Tip Regarding Session
#########################

We have seen some of our students try to modify the session data by doing something like below:
*/

// $this->session->set_userdata('message') = "new message";

// or

$this->session->set_userdata('messages')[] = "new message";

// WARNING: Both will NOT work! Some of our students have spent hours trying to fix problems caused by this so make sure you're using proper syntax to update the Session data.

// Above basically retrieves the current message or messages(array) and sets it to be the new value but does not save the information back in the session. The proper way to do this is to do something like below:

$this->session->set_userdata('message', "new message");
$this->session->set_userdata('messages', array('new message'));

#########################
## Running echo() or var_dump() Before Changing the Session Data
#########################

// CodeIgniter seems to have a bug where if you echo anything or var_dump any variable BEFORE you change the session variable, it refuses to change the session variable. For example, consider the codes below.

//Bad example of changing session:

echo "session counter is" . $this->session->userdata('counter');
$this->session->set_userdata('counter', rand(20,50));
echo "changed session counter to be" . $this->session->userdata('counter');

// When above codes run, it may seem like 'counter' is being updated to a new random number, however, regardless of how many times you reload the page and execute these codes, it will fail to update session['counter']. What happens is that any change in session after you echo or var_dump is completely ignored... To avoid this issue, always change the SESSION data and THEN echo or var_dump the data. For example below would be okay as you change the session and then echo something.

// Good example of changing session:

$old_counter = $this->session->userdata('counter');
$this->session->set_userdata('counter', rand(20,50));
echo "session counter was" . $old_counter;
echo "changed session counter to be" . $this->session->userdata('counter');
?>