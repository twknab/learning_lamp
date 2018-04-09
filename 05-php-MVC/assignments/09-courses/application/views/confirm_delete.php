<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Courses - Confirm Delete</title>
  <style>
   button, input[type="submit"]{
     padding: 10px;
   }
   input[type="submit"] {
     background-color: red;
     color: white;
   }
  </style>
</head>
<body>
  <h1>Are you sure you want to delete this course?</h1>
  <ul>
    <li><strong>Name:</strong> <?=$course["name"]?></li>
    <li><strong>Description:</strong> <?=$course["description"]?></li>
  </ul>
  <form action="/delete/<?=$course_id?>">
    <button formaction="/" formmethod="GET">Cancel</button>
    <input type="submit" value="Yes! I want to Permanently Delete this file">
  </form>
</body>
</html>