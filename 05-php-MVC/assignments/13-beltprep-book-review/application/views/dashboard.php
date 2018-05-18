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
      overflow-y: scroll; 
    }
  </style>
</head>
<body>
 <h1>Welcome, {{Jessie}}!</h1>
 <a href="review/add">Add Book and Review</a>
 <a href="logout">Logout</a>
 <fieldset>
    <legend>Recent Book Reviews</legend>
    <a href="/books/1">The Greatest Salesman in The World</a>
    <p>Rating: [X] [X] [X] [X] [X]</p>
    <a href="/users/1">Jerry</a> says: very inspiring and lots of wisdom.
    <p>Posted on November 25, 2014</p> 
 </fieldset>
 <fieldset>
    <legend>Other Books with Reviews</legend>
    <div id="more-reviews">
      <a href="/books/2">Harry Potter: The Sorcerer's Stone</a>
    </div>
 </fieldset>
</body>
</html>