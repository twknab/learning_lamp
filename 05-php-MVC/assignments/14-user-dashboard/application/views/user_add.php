<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add New User</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <ul class="top-nav">
    <li><a href="../../load_dashboard">Dashboard</a></li>
    <li><a href="../edit">Profile</a></li>
    <li><a href="../../logoff">Logoff</a></li>
  </ul>
 <h1>Add a New User</h1>
 <fieldset>
    <legend>Add New User below:</legend>
      <?php if (isset($errors_new_user)) { ?>
        <div class="err"><?=$errors_new_user?></div>
      <?php } ?>
      <?php 
        $hidden = array('description' => '', 'form_name' => 'admin_add_user'); 
        echo form_open('/register', '', $hidden); 
      ?>
      <input type="email" name="email" id="email" placeholder="Email Address">
      <input type="text" name="first_name" id="first_name" placeholder="First Name">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name">
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Password Confirmation">
      <input type="submit" value="Create">
    </form>
 </fieldset>
</body>
</html>