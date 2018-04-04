<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Courses</title>
  <style>
   
  </style>
</head>
<body>
  <fieldset>
    <legend>
      <h1>Add a New Course</h1>
    </legend>
    <form action="/add_course" method="POST">
      <p>Name: <input type="text" name="name" id="name"></p>
      <p>Description:</p>
      </p><textarea name="description" id="description" cols="30" rows="20"></textarea></p>
      <input type="submit" value="Add">
    </form>
  </fieldset>
  <fieldset>
    <legend><h2>Courses</h2></legend>
    <table>
      <tr>
        <th>Course Name</th>
        <th>Description</th>
        <th>Date Added</th>
        <th>Actions</th>
      </tr>
      <tr>
        <td>Be a Ninja</td>
        <td></td>
        <td>Dec 1st 2018 5:34PM</td>
        <td><a href="/confirm_delete/3">Remove</a></td>
      </tr>
    </table>
  </fieldset>
</body>
</html>