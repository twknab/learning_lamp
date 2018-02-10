
<?php
  session_start();
  $errors = [];
  // Here's an alternative approach -->

  if (!empty($_POST)){
    if (!$_POST['first_name']){
      $errors[] = "First Name is required";
    }
    else if (!ctype_alpha($_POST['first_name'])){
      $errors[] = "First Name cannot have any numbers";
    }
    if (!$_POST['last_name']){
      $errors[] = "Last Name is required";
    } else if (!ctype_alpha($_POST['last_name'])){
      $errors[] = "Last Name cannot have any numbers";
    }
    if (!$_POST['email']){
      $errors[] = "Email is required";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
      $errors[] = "Email is not valid";
    }
    if (!$_POST['password']){
      $errors[] = "Pasword is required";
    } else if (strlen($_POST['password']) <= 6){
      $errors[] = "Password must be greater than 6 characters";
    }
    if (!$_POST['c_password']){
      $errors[] = "Password Confirmation is required";
    } else if ($_POST['c_password'] != $_POST['password']){
      $errors[] = "Passwords must match";
    }
    //birthdate validation gets lengthy but is easy-to-follow
    if (!$_POST['birthdate']){
      $errors[] = "Birthdate is required";
    } else {
      $date = explode('-', $_POST['birthdate']);
      // $date is an array with MM in 0 index, DD in 1, YYYY in 2
      $month = $date[0];
      $day = $date[1];
      $year = $date[2];
      if (!checkdate($month, $day, $year)){
        $errors[] = "Birthdate invalid";
      }
    }
    //file upload
    if ($_FILES['profile_pic']['size'] > 0){
      $dir_to_upload = './uploads';
      $name = $_FILES['profile_pic']['name'];
      if (!move_uploaded_file($_FILES['profile_pic']['tmp_name'], "$dir_to_upload/$name")){
        $errors[] = "File could not be uploaded";
      }
    }

  }

  if (empty($errors)) {
    $_SESSION['success'] = true;
  }
  $_SESSION['errors'] = $errors;

  //regardless, going to send user back to index and show errors or a success message
  header('location: index.php');
  die();
 ?>
