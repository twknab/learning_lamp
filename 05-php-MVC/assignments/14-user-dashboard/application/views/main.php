<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>LAMP User Dashboard</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <ul class="top-nav">
    <li><a href="/">User Dashboard</a></li>
    <li><a href="/">Home</a></li>
    <li><a href="/signin">Sigin</a></li>
  </ul>
 <h1>Welcome to the User Dashboard!</h1>
 <p>This is a user dashboard MVC application built with the LAMP stack.</p>
 <?php echo form_open('/signin', 'method="GET"'); ?>
      <!-- Note: You might like to use more form_helpers here, but for now because we're timed, let's keep moving with what we know -->
      <input type="submit" value="Start">
 </form>
 <h3>You can:</h3>
 <ul>
   <li>Manage Users: Using this application, you add, remove or edit users (admins only).</li>
   <li>Leave Message: Users will be able to leave one another messages.</li>
   <li>Edit User Information: Admins will be able to edit another user's information, and users can edit their own information.</li>
 </ul>
</body>
</html>