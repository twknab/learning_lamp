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
    <li><a href="/">User Dashboard</a></li>
    <li>
      <?php 
        if ($logged_in['user_level'] === 9)
        { ?>
          <a href="../../dashboard">
        <?php  }
        else
        { ?>
        <a href="../../dashboard/admin">
        <?php }
      ?>Dashboard
      </a>
    </li>
    <li><a href="../edit">Profile</a></li>
    <li><a href="../../logoff">Logoff</a></li>
  </ul>
 <h1>Edit Profile</h1>
 <fieldset>
    <legend>Edit Information:</legend>
      <?php if (isset($errors_info)) { ?>
        <div class="err"><?=$errors_info?></div>
      <?php } ?>
      <?php 
        echo form_open('/users/edit/info'); 
      ?>
      <input type="email" name="email" id="email" placeholder="Email Address">
      <input type="text" name="first_name" id="first_name" placeholder="First Name">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name">
      <input type="submit" value="Save">
    </form>
 </fieldset>
 <fieldset>
    <legend>Change Password:</legend>
      <?php if (isset($errors_pass)) { ?>
        <div class="err"><?=$errors_pass?></div>
      <?php } ?>
      <?php 
        echo form_open('/users/edit/password'); 
      ?>
      <input type="email" name="email" id="email" placeholder="Email Address">
      <input type="text" name="first_name" id="first_name" placeholder="First Name">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name">
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
      <textarea name="description" id="description" cols="30" rows="20" placeholder="Enter a description about yourself."></textarea>
      <input type="submit" value="Save">
    </form>
 </fieldset>
</body>
</html>