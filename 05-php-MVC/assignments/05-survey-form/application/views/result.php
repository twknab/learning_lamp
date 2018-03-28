<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Codeigniter Survey Result</title>
  <style>
    .count {
      padding: 20px;
      margin: 15px auto;
      text-align: center;
      width: 500px;
      background-color: lightgreen;
      border: 2px solid darkgreen;
    }
    .info {
      padding: 20px;
      width: 500px;
      margin: 15px auto;
    }
  </style>
</head>
<body>
  <div class="count">
    <h2>Thanks for submitting this form! You've submitted this form <?=$count?> times now.</h2>
    <form action="/">
      <input type="submit" value="Go Back!">
    </form>
  </div>
  <fieldset class="info">
    <legend>Submitted Information</legend>
    <ul>
      <li>Name: <?=$survey["name"]?></li>
      <li>Dojo Location: <?=$survey["location"]?></li>
      <li>Favorite Language: <?=$survey["language"]?></li>
      <li>Comment: <?=$survey["comment"]?></li>
    </ul>
  </fieldset>
</body>
</html>