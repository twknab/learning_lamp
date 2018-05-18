<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome to LAMP Book Reviewer</title>
  <style>
    body {
     font-family: arial, courier; 
    }
    .err {
      padding: 15px;
      border: 1px solid silver;
      background: lightgrey;
      text-align: center;
      font-style: italic;
      margin: 15px;
    }
  </style>
</head>
<body>
 <h1>Welcome!</h1>
 <fieldset>
    <legend>Register</legend>
      <?php if (isset($errors_registration)) { ?>
        <div class="err"><?=$errors_registration?></div>
      <?php } ?>
      <?php echo form_open('user/register'); ?>
      <!-- Note: You might like to use more form_helpers here, but for now because we're timed, let's keep moving with what we know -->
      <input type="text" name="name" id="name" placeholder="Full Name">
      <input type="text" name="alias" id="alias" placeholder="Alias">
      <input type="email" name="email" id="email" placeholder="Email">
      <input type="password" name="password" id="password" placeholder="Password">
      <input type="password" name="password_confirm" id="password_confirm" placeholder="Confirm Password">
      <input type="submit" value="Register">
    </form>
 </fieldset>
 <fieldset>
    <legend>Login</legend>
      <?php if (isset($errors_login)) { ?>
        <div class="err"><?=$errors_login?></div>
      <?php } ?>
      <?php echo form_open('user/login'); ?>
      <input type="email" name="email" id="email" placeholder="email">
      <input type="password" name="password" id="password">
      <input type="submit" value="Login">
    </form>
 </fieldset>
</body>
</html>