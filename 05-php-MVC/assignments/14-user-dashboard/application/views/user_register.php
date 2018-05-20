<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Register</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <ul class="top-nav">
    <li><a href="/">Home</a></li>
    <li><a href="/signin">Sigin</a></li>
  </ul>
 <h1>Register</h1>
 <fieldset>
    <legend>Register below:</legend>
      <?php if (isset($errors_registration)) { ?>
        <div class="err"><?=$errors_registration?></div>
      <?php } ?>
      <?php 
        $hidden = array('description' => '', 'form_name' => 'register'); 
        echo form_open('/register', '', $hidden); 
      ?>
      <input type="email" name="email" id="email" placeholder="Email Address">
      <input type="text" name="first_name" id="first_name" placeholder="First Name">
      <input type="text" name="last_name" id="last_name" placeholder="Last Name">
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Password Confirmation">
      <input type="submit" value="Register">
      <p>
        <a href="/signin">Already have an account? Login!</a>
      </p>
    </form>
 </fieldset>
</body>
</html>