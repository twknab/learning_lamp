<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add a Book and Review</title>
  <style>
    body {
     font-family: arial, courier; 
    }
    .date {
      font-size: 12px;
      font-style: italic;
    }
  </style>
</head>
<body>
 <p><a href="/books">Home</a></p>
 <p><a href="logout">Logout</a></p>
 <h1><?=$book->title?></h1>
 <h3>Author: <?=$book->name?></h3>
 <fieldset>
    <legend><h2>Reviews:</h2></legend>
    <?php var_dump($reviews) ?>
    <?php foreach ($reviews as $review) { ?>
      <p>Rating:
        <?php 
          for ($i = 0; $i < $review['rating']; $i++) { ?>
            <img src="<?php echo base_url('assets/images/star-full.png'); ?>">
          <?php } ?>
          <?php 
            $empty = 5-$review['rating'];
            for ($j = 0; $j < $empty; $j++)
            { 
          ?>
             <img src="<?php echo base_url('assets/images/star-empty.png'); ?>">
          <?php } ?>
      </p>
      <blockquote>
        <a href="/users/<?=$review['user_id']?>"><?=$review['alias']?></a> says: <em><?=$review['description']?></em>
        <p class="date">Posted on <?=date_format(new DateTime($review['created_at']), 'M d, Y')?></p>
        <?php if ($user['id'] == $review['user_id']) { ?> 
          <a href="/review/delete/<?=$review['id']?>/<?=$review['book_id']?>">Delete this Review</a>
        <?php } ?>
      </blockquote>
    <?php } ?>

 </fieldset>
 <fieldset>
   <legend><h2>Add Review:</h2></legend>
   <?php 
    $hidden = array('book_id' => 1,'author_id' => 2);
    echo form_open('review/new', '', $hidden); 
   ?>
   <textarea name="description" id="description" cols="30" rows="20" placeholder="Review description"></textarea>
   <select name="rating" id="rating">
    <option value="">Choose a rating...</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
   </select>
   <input type="submit" value="Submit Review">
 </fieldset>
</body>
</html>