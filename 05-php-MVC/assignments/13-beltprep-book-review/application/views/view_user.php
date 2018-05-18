<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User Reviews</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body>
 <p><a href="/books">Home</a></p>
 <p><a href="/books/add">Add Book and Review</a></p>
 <p><a href="../logout">Logout</a></p>
 <h1>User Alias: <?=$user['alias']?></h1>
 <fieldset>
    <legend><h2>Details:</h2></legend>
    <ul>
      <li>Name: <?=$user['name']?></li>
      <li>Email: <?=$user['email']?></li>
      <li>Total Reviews: <?=$reviews_count->total_reviews?> </li>
    </ul>

    <p>Posted Reviews on the following books:</p>
    <ul>
      <?php foreach ($reviews as $review) { ?>
        <li><a href="../books/<?=$review['book_id']?>"><?=$review['title']?></a></li>

      <?php } ?>
    </ul>
 </fieldset>
</body>
</html>