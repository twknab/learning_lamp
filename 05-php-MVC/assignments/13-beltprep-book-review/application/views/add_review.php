<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add a Book and Review</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
 <p><a href="/books">Home</a></p>
 <p><a href="../logout">Logout</a></p>
 <fieldset>
    <legend><h2>Add a New Book Title and a Review:</h2></legend>
  <?php if (isset($errors_review)) { ?>
    <div class="err"><?=$errors_review?></div>
  <?php } ?>
  <?php 
    $hidden = array('user_id' => $user['id']);
    echo form_open('review/new', '', $hidden); 
  ?>
  <p>
    <input type="text" name="title" id="title" placeholder="Book Title">
  </p>
  <p>
    <?php 
    ?>
    <select name="existing_author" id="existing_author">
      <option value="">Choose an Existing Author...</option>
    <?php foreach ($authors as $author) { ?>
        <option value="<?=$author["id"]?>">
          <?=$author["name"]?>
        </option>
      <?php } ?>
    </select>
  </p>
  <p>
    <input type="text" name="new_author" id="new_author" placeholder="Or add a New Author...">
  </p>
  <textarea name="description" id="description" cols="30" rows="20" placeholder="Write your Book Review here..."></textarea>
  <p>
    <select name="rating" id="rating">
      <option value="">Choose a Rating...</option>
      <option value="5">5</option>
      <option value="4">4</option>
      <option value="3">3</option>
      <option value="2">2</option>
      <option value="1">1</option>
    </select>
  </p>
  <input type="submit" value="Add Book & Review">
</form>
 </fieldset>
</body>
</html>