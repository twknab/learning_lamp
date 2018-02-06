<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Forms using PHP</title>
</head>
<body>
  <h3>Submit a Form Using GET</h3>
  <form action="some_page.php">
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <input type="submit">
  </form>
  <h3>Submit a Form Using POST</h3>
  <form action="some_page.php" method="POST">
    <input type="text" name="first_name" placeholder="First Name">
    <input type="text" name="last_name" placeholder="Last Name">
    <input type="submit">
  </form>
</body>
</html>
