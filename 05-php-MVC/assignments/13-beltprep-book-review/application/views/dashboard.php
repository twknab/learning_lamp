<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Books Home</title>
  <style>
    body {
     font-family: arial, courier; 
    }
    #more-reviews {
      height: 200px;
      overflow-y: scroll; 
    }
    .date {
      font-size: 12px;
      font-style: italic;
    }
  </style>
</head>
<body>
 <h1>Welcome, <?=$user['alias']?>!</h1>
 <p>
  <a href="books/add">Add Book and Review</a>
  <a href="logout">Logout</a>
 </p>
 <fieldset>
    <legend><h2>Recent Book Reviews</h2></legend>
    <?php foreach ($reviews as $review) { ?>
      <a href="/books/<?=$review['book_id']?>"><?=$review['title']?></a>
      <blockquote>
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
          <?php  
            }
          ?>
        </p>
        <a href="/users/<?=$review['user_id']?>"><?=$review['name']?></a> says: <?=$review['description']?>.
        <p class="date">Posted on <?=date_format(new DateTime($review['created_at']), 'M d, Y')?></p> 
      </blockquote>
    <?php } ?>
 </fieldset>
 <fieldset>
    <legend><h2>Other Books with Reviews</h2></legend>
    <?php 
    ?>
    <div id="more-reviews">
      <?php foreach ($other_reviews as $review) { 
        var_dump($review);
        ?>
        <p><a href="/books/<?=$review['book_id']?>"><?=$review['title']?></a></p>
      <?php } ?>
    </div>
 </fieldset>
</body>
</html>