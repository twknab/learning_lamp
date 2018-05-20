<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit User</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <ul class="top-nav">
    <li><a href="/load_dashboard">Dashboard</a>
    </li>
    <li><a href="../edit">Profile</a></li>
    <li><a href="../../logoff">Logoff</a></li>
  </ul>
 <h1>Edit User <?=$user['id']?></h1>
 <fieldset>
   <legend>Back to Dashboard</legend>
   <?php echo form_open('/load_dashboard') ?>
    <input type="submit" value="Return to Dashboard">
  </form>

 </fieldset>
 <fieldset>
    <legend>Edit Information:</legend>
      <?php if (isset($errors_info)) { ?>
        <div class="err"><?=$errors_info?></div>
      <?php } ?>
      <?php 
        $hidden = array('user_id' => $user['id'], 'form_name' => 'admin_edit_info');
        echo form_open('/users/edit/info', '', $hidden); 
      ?>
      <input type="email" name="email" id="email" placeholder="Email Address" value="<?=$user['email']?>">
      <input type="text" name="first_name" id="first_name" placeholder="First Name" value="<?=$user['first_name']?>">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name" value="<?=$user['last_name']?>">
      <select name="user_level" id="user_level">
        <option value="1" 
          <?php if (intval($user['user_level']) !== 9) { ?>
            selected
          <?php } ?>
        >Normal</option>
        <option value="9"
          <?php if (intval($user['user_level']) === 9) { ?>
            selected
          <?php } ?>
        >Admin</option>
      </select>
      <input type="submit" value="Save">
    </form>
 </fieldset>
 <fieldset>
    <legend>Change Password:</legend>
      <?php if (isset($errors_password)) { ?>
        <div class="err"><?=$errors_password?></div>
      <?php } ?>
      <?php 
        $hidden = array('user_id' => $user['id'], 'form_name' => 'admin_edit_pass');
        echo form_open('/users/edit/password', '', $hidden); 
      ?>
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Password Confirmation">
      <input type="submit" value="Update Password">
    </form>
 </fieldset>
</body>
</html>