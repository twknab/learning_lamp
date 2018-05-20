<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Information</title>
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
 <h1>
   <?php $user['first_name'] . $user['last_name']; ?>
 </h1>
 <fieldset>
    <legend>User Info:</legend>
    <ul>
      <li>Registered at: <?=$user['created_at']?></li>
      <li>User ID: <?=$user['user_id']?></li>
      <li>Email Address: <?=$user['email']?></li>
      <li>Description: 
        <p><?=$user['description']?></p>
      </li>
    </ul>
 </fieldset>
 <fieldset>
    <legend>
      Leave a message for <?=$user['first_name']?>:
    </legend>
      <?php if (isset($errors_message)) { ?>
        <div class="err"><?=$errors_message?></div>
      <?php } ?>
      <?php 
        $hidden = array('sender_id' => $logged_in['id'], 'receiver_id' => $user['id']);
        echo form_open('/message', '', $hidden); 
        
      ?>
      <textarea name="message" id="message" cols="30" rows="20" placeholder="Leave your message here."></textarea>
      <input type="submit" value="Post">
    </form>
 </fieldset>
 <h2>Messages:</h2>
 <div class='message'>
   <p>Mark Gullen wrote (7 hours ago):</p>
   <p>Yo thiis is cool!</p>
   <div class='comment'>
     <p>Diana wrote: (23 minutes ago)</p>
     <p>Awesome!</p>
   </div>
    <?php if (isset($errors_comment)) { ?>
      <div class="err"><?=$errors_comment?></div>
    <?php } ?>
    <?php 
      $hidden = array('sender_id' => $logged_in['id'], 'receiver_id' => $user['id'], 'message_id' => $message['id']);
      echo form_open('/comment', 'class="comment-form"', $hidden); 
    ?>
      <textarea name="comment" id="comment" cols="30" rows="20" placeholder="Leave a comment here."></textarea>
      <input type="submit" value="Post">
    </form>
 </div>
</body>
</html>