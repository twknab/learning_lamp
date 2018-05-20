<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Sign In</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
  <ul class="top-nav">
    <li><a href="/">Home</a></li>
    <li><a href="/register">Register</a></li>
  </ul>
 <h1>Sign In</h1>
 <fieldset>
    <legend>Login below:</legend>
      <?php if (isset($errors_login)) { ?>
        <div class="err"><?=$errors_login?></div>
      <?php } ?>
      <?php echo form_open('/signin'); ?>
      <input type="email" name="email" id="email" placeholder="Email Address">
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="submit" value="Sign In">
      <p>
        <a href="/register">Don't have an account? Register</a>
      </p>
    </form>
 </fieldset>
</body>
</html>