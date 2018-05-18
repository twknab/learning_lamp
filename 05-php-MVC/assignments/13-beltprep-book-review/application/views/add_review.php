<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add a Book and Review</title>
  <style>
    body {
     font-family: arial, courier; 
    }
  </style>
</head>
<body>
 <a href="/">Home</a>
 <a href="logout">Logout</a>
 <fieldset>
    <legend>Add a New Book Title and a Review:</legend>
  <?php if (isset($errors_review)) { ?>
    <div class="err"><?=$errors_review?></div>
  <?php } ?>
  <?php echo form_open('review/new'); ?>
  <input type="text" name="title" id="title" placeholder="Book Title">
  <select name="existing_author" id="existing_author">
    <option value="" selected>Choose existing Author...</option>
    <option value="{{1}}">Stephen King</option>
  </select>
  <textarea name="description" id="description" cols="30" rows="20" placeholder="Review"></textarea>
  <select name="rating" id="rating">
    <option value="">Choose a rating...</option>
    <option value="5">5</option>
    <option value="4">4</option>
    <option value="3">3</option>
    <option value="2">2</option>
    <option value="1">1</option>
  </select>
  <input type="submit" value="Add Book & Review">
</form>
 </fieldset>
</body>
</html>