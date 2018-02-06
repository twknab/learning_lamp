<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Survey Form using PHP</title>
</head>
<body>
  <h3>Submit a Survey</h3>
  <form action="result.php" method="POST">
    <label for="name">Full Name</label>
    <input type="text" name="name" placeholder="Your Full Name" required>
    <label for="location">Dojo Location</label>
    <select name="location" required>
      <option value="Seattle">Seattle</option>
      <option value="Mountain View">Mountain View</option>
      <option value="Dallas">Dallas</option>
      <option value="Chicago">Chicago</option>
    </select>
    <label for="language">Favorite Language</label>
    <select name="language" required>
      <option value="JavaScript">JavaScript</option>
      <option value="Python">Python</option>
      <option value="Ruby">Ruby</option>
      <option value="PHP">PHP</option>
    </select>
    <label for="comment"></label>
    <textarea name="comment" rows="10" cols="80"></textarea>
    <input type="submit" value="Submit Survey">
  </form>
</body>
</html>
