<?php 
require_once(APPPATH.'modules/time.php');
?>
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
    <li><a href="../../load_dashboard">Dashboard</a></li>
    <li><a href="../edit">Profile</a></li>
    <li><a href="../../logoff">Logoff</a></li>
  </ul>
 <h1>
   <?php $user['first_name'] . $user['last_name']; ?>
 </h1>
 <fieldset>
   <h1><?=$user['first_name'] . " " . $user['last_name']?></h1>
    <legend>User Info:</legend>
    <ul>
      <li>Registered: <?=date_format(new DateTime($user['created_at']), 'M dS, Y')?></li>
      <li>User ID: <?=$user['id']?></li>
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
 <?php 
  if (count($messages) >= 1) 
  {
    foreach ($messages as $message) 
    {
 ?>
  <div class='message'>
    <p><strong><a href="/users/show/<?=$message['user_id']?>"><?=$message['first_name'] . " " . $message['last_name']?></strong></a> wrote (<?php echo time_ago(strtotime($message['created_at']))?>):</p>
    <p><?=$message['message']?></p>
    <?php 
      foreach ($comments as $comment) 
      {
        if ($comment['message_id'] === $message['id']) 
        { ?>
          <div class='comment'>
            <p><a href="/users/show/<?=$comment['user_id']?>"><?=$comment['first_name'] . " " . $comment['last_name']?></a> wrote: (<?php echo time_ago(strtotime($comment['created_at']))?>)</p>
            <p><?=$comment['comment']?></p>
          </div>
        <?php }
      }
    ?>
    <?php if (isset($errors_comment)) { ?>
      <div class="err"><?=$errors_comment?></div>
    <?php } ?>
    <?php 
      $hidden = array('sender_id' => $logged_in['id'], 'receiver_id' => $user['id'], 'message_id' => $message['id']);
      echo form_open('/comment', 'class="comment-form"', $hidden); 
    ?>
      <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Leave a comment here."></textarea>
      <input type="submit" value="Post">
    </form>
  </div>
 <?php }
  } // NO MESSAGES YET
  else { ?>
    <p>No messages yet!</p>
  <?php }
 ?>
</body>
</html>