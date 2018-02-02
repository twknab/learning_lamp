<!--
Given the following array:

$users = array(
   array('first_name' => 'Michael', 'last_name' => 'Choi'),
   array('first_name' => 'John', 'last_name' => 'Supsupin'),
   array('first_name' => 'Mark', 'last_name' => 'Guillen'),
   array('first_name' => 'KB', 'last_name' => 'Tonel')
);

Create a program that outputs a beautiful HTML table like this:

Make sure that the length of the name comes out to be 11, 12, 11. Hint: You may need to use a PHP function called trim().

Also, add 10 more entries to $users array. For every 5th row, highlight the row so that it shows a black background with white font color.
-->

<style>
  table {
    margin: 20px;
    border-collapse: collapse;
  }
  table, th, td {
    padding: 10px;
  }
  th, td {
    border: 1px solid lightgrey;
    border-collapse: collapse;
  }
  tbody tr:nth-child(5n+6) {
     background-color: #ccc;
  }
  /* Give first column bold stying */
  td:first-child {
    font-weight: bolder;
  }
</style>

<?php
// Here we go:
function html_table($array) {
  $html_str = "<table>";
    $html_str .= "<tr>";
      $html_str .= "<th>User #</td>";
      $html_str .= "<th>First Name</td>";
      $html_str .= "<th>Last Name</td>";
      $html_str .= "<th>Full Name</td>";
      $html_str .= "<th>Full Name in upper case</td>";
      $html_str .= "<th>Length of full name (without spaces)</td>";
    $html_str .= "</tr>";
  foreach ($array as $index => $value) {
    $html_str .= "<tr>";
      $html_str .= "<td>" . ($index + 1) . "</td>";
      $html_str .= "<td>" . $value["first_name"] . "</td>";
      $html_str .= "<td>" . $value["last_name"] . "</td>";
      $html_str .= "<td>" . $value["first_name"] . " " . $value["last_name"] . "</td>";
      $html_str .= "<td>" . strtoupper($value["first_name"] . " " . $value["last_name"]) . "</td>";
      $html_str .= "<td>" . strlen(str_replace(' ', '', ($value["first_name"] . " " . $value["last_name"]))) . "</td>";
    $html_str .= "</tr>";
  };
  $html_str .= "</table>";
  // Print html_str to page:
  echo $html_str;
};

// Build our array:
$users = array(
  array('first_name' => 'Michael', 'last_name' => 'Choi'),
  array('first_name' => 'John', 'last_name' => 'Supsupin'),
  array('first_name' => 'Mark', 'last_name' => 'Guillen'),
  array('first_name' => 'KB', 'last_name' => 'Tonel'),
  array('first_name' => 'Tim', 'last_name' => 'Knab'),
  array('first_name' => 'Julianna', 'last_name' => 'Giles'),
  array('first_name' => 'Chris', 'last_name' => 'Knab'),
  array('first_name' => 'Danielle', 'last_name' => 'Knab'),
  array('first_name' => 'John', 'last_name' => 'Knab'),
  array('first_name' => 'Vida', 'last_name' => 'Knab'),
);

// Run our function:
html_table($users);



?>
