<!-- We can use include to grab content from a php file -->
<h1>This is my webpage</h1>
<fieldset><legend>See my works!</legend>
  <!-- The HTML content in content.php should appear here -->
  <?php include("content.php"); ?>
</fieldset>

<!-- Note: We can also import functions and utilize them -->
<fieldset><legend>My friends:</legend>
  <!-- We can call functions if we import them via PHP -->
  <!-- Also notice the variation here, `include_once()` ensures that if a duplicate was included, the duplicate would be ignored -->
  <?php include_once("functions.php");
    print_name("Julianna"); // note that `print_name()` is defined in `functions.php`
    print_name("Chris");
    print_name("Julian");
    print_name("Jared");
  ?>
</fieldset>

<fieldset><legend>We can also use require</legend>
  <?php require("things.php"); ?>
</fieldset>
