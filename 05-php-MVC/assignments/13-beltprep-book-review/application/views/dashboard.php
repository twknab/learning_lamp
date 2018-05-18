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
    <a href="/books/1">The Greatest Salesman in The World</a>
    <blockquote>
      <p>Rating: [X] [X] [X] [X] [X]</p>
      <a href="/users/1">Jerry</a> says: very inspiring and lots of wisdom.
      <p class="date">Posted on November 25, 2014</p> 
    </blockquote>
 </fieldset>
 <fieldset>
    <legend><h2>Other Books with Reviews</h2></legend>
    <div id="more-reviews">
      <a href="/books/2">Harry Potter: The Sorcerer's Stone</a>
    </div>
 </fieldset>
</body>
</html>