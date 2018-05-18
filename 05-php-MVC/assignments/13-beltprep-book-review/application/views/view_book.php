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
  </style>
</head>
<body>
 <p><a href="/">Home</a></p>
 <p><a href="logout">Logout</a></p>
 <h1>{{Divergent}}</h1>
 <h3>Author: Veronica Roth</h3>
 <fieldset>
    <legend><h2>Reviews:</h2></legend>
    <p>Rating: [X] [X] [X] [] []</p>
    <a href="/users/1">Shirley</a> says: <em>My daughter loves reading this. I don't know why.</em>
    <p><em>Posted on November 21, 2014</em></p>
    <a href="/review/delete/1">Delete this Review</a>
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