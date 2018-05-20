<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>

<body>
  <ul class="top-nav">
    <li>
      <a href="/load_dashboard">Dashboard</a>
    </li>
    <li>
      <a href="/users/edit">Profile</a>
    </li>
    <li>
      <a href="/logoff">Log Off</a>
    </li>
  </ul>
  <h1>Manage Users</h1>
  <fieldset>
    <legend>Add New User</legend>
    <?php 
      echo form_open('/users/new', 'method="GET"'); 
    ?>
      <input type="submit" value="Add New">
    </form>
  </fieldset>
  <fieldset>
    <legend>Manage Users Below:</legend>
    <table>
      <tr>
        <th>ID</th>
        <th>Name*</th>
        <th>Email</th>
        <th>Created At</th>
        <th>User Level</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($users as $user) { ?>
        <tr>
            <td><?=$user['id']?></td>
            <td><a href="../users/show/<?=$user['id']?>"><?=$user['first_name'] . " " .$user['last_name']?></a></td>
            <td><?=$user['email']?></td>
            <td><?=date_format(new DateTime($user['created_at']), 'M dS, Y')?></td>
            <td>                
              <?php if (intval($user['user_level']) === 9) { ?>
                  <p>admin</p>
              <?php } else { ?>
                  <p>normal</p>
              <?php } ?>
            </td>
            <td>
              <a href="../users/edit/<?=$user['id']?>">Edit</a> <a href="../users/remove/<?=$user['id']?>">Remove</a>
            </td>
        </tr>
      <?php  } ?>
    </table>
  </fieldset>
</body>

</html>