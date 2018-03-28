<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>CodeIgniter Survey Form</title>
  <style>

  </style>
</head>
<body>
  <h1>CodeIgniter Survey</h1>
  <form action="/main/survey" method="POST">
    <p>Your Name: <input type="text" name="name" id="name" required></p>
    <p>Dojo Location: <select name="location" id="location" required>
      <option value="Mountain View">Mountain View</option>
      <option value="Seattle">Seattle</option>
      <option value="Chicago">Chicago</option>
      <option value="Dallas">Dallas</option>
    </select></p>
    <p>Favorite Language: <select name="language" id="language" required>
      <option value="JavaScript">JavaScript</option>
      <option value="PHP">PHP</option>
      <option value="Python">Python</option>
      <option value="Ruby">Ruby</option>
    </select></p>
    <p>Comment (optional)<textarea name="comment" id="comment" cols="30" rows="10"></textarea></p>
    <input type="submit" value="Submit">
  </form>
</body>
</html>