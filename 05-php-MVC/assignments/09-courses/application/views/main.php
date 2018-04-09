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
    body {
      font-family: "arial";
    }
   .err {
     padding: 10px;
     margin: 15px auto;
     width: 400px;
     background-color: orange;
     border: 2px solid orangered;
   }
   table {
     width: 100%;
     text-align: center;
   }
   input[type="submit"] {
     padding: 10px;
   }
  </style>
</head>
<body>
  <fieldset>
    <legend>
      <h1>Add a New Course</h1>
    </legend>
    <form action="/add_course" method="POST">
      <?php 

          if (isset($errors)) {
            echo "<div class='err'>${errors}</div>";
          }

      ?>
      <p>Name: <input type="text" name="name" id="name"></p>
      <p>Description:</p>
      </p><textarea name="description" id="description" cols="30" rows="20"></textarea></p>
      <input type="submit" value="Add">
    </form>
  </fieldset>
  <?php if ($courses) { ?>
  <fieldset>
    <legend><h2>Courses</h2></legend>
    <table>
      <tr>
        <th>Course Name</th>
        <th>Description</th>
        <th>Date Added</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($courses as $course) { ?>
        <tr>
          <td><?=$course["name"]?></td>
          <td><?=$course["description"]?></td>
          <td><?=date_format(new DateTime($course['created_at']), 'M dS Y h:iA')?></td>
          <td><a href="/confirm_delete/<?=$course["id"]?>">Remove</a></td>
        </tr>
      <?php } ?>
    </table>
  </fieldset>
  <?php } ?>
</body>
</html>