<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <ul class="top-nav">
    <li><a href="/load_dashboard">Dashboard</a>
    <li><a href="/logoff">Log Off</a></li>
 <h1>Edit Profile</h1>
 <fieldset>
    <legend>Edit Information:</legend>
      <?php if (isset($errors_info)) { ?>
        <div class="err"><?=$errors_info?></div>
      <?php } ?>
      <?php 
        $hidden = array('form_name' => 'edit_info');
        echo form_open('/users/edit/info', '', $hidden); 
      ?>
      <input type="email" name="email" id="email" placeholder="Email Address" value="<?=$logged_in['email']?>">
      <input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?=$logged_in['first_name']?>">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?=$logged_in['last_name']?>">
      <input type="submit" value="Save Details">
    </form>
 </fieldset>
 <fieldset>
    <legend>Change Password:</legend>
      <?php if (isset($errors_password)) { ?>
        <div class="err"><?=$errors_password?></div>
      <?php } ?>
      <?php
        $hidden = array('form_name' => 'edit_pass');
        echo form_open('/users/edit/password', '', $hidden); 
      ?>
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Password Confirmation">
      <input type="submit" value="Update Password">
    </form>
 </fieldset>
 <fieldset>
    <legend>Edit Description:</legend>
      <?php if (isset($errors_desc)) { ?>
        <div class="err"><?=$errors_desc?></div>
      <?php } ?>
      <?php
        echo form_open('/users/edit/desc'); 
      ?>
      <textarea name="description" id="description" cols="30" rows="20" placeholder="Enter a description about yourself."><?=$logged_in['description']?></textarea>
      <input type="submit" value="Save Description">
    </form>
 </fieldset>
</body>
</html>