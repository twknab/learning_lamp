<?php
// Multi-dimensional arrays can be useful when we need to hold arrays of arrays -- this is important when dealing with larger data sets.

// Below is an example of how you could use it in the real world:
$exams = array(
 array(
  'title' => 'Yellow Belt Exam',
  'language' => 'HTML & CSS'
 ),
 array(
  'title' => 'Red Belt Exam',
  'language' => 'PHP using CodeIgniter'
 ),
 array(
  'title' => 'Black Belt Exam',
  'language' => 'Ruby using Ruby on Rails'
 )
);

// And to access it manually, we do:

echo $exams[0]['title'];
//prints out 'Yellow Belt Exam'

// Cool, huh? If you remember back to the loops tab, we use the foreach loop to iterate through an array. Using concatenation, we can do something like this:

foreach($exams as $exam) {
 echo "<p>" . $exam['title'] ."-". $exam['language'] . "</p>";
}

// As mentioned on the variables tab, we can implement the better way of printing both strings and variables like this:

foreach($exams as $exam) {
 echo "<p> ${exam['title']} - ${exam['language']} </p>";
}

// But wait... When you run the code above you will receive a very weird error message!

// The problem is that PHP requires you to tell it explicitly when the variable you are retrieving is coming from an associative array. To do this, we need to enclose the entire reference to the array and variable within curly braces. So the correct code would be:

foreach($exams as $exam) {
 echo "<p> {$exam['title']} - {$exam['language']} </p>";
}

// Result:
/*
Yellow Belt Exam - HTML & CSS
Red Belt Exam - PHP using CodeIgniter
Black Belt Exam - Ruby using Ruby on Rails
*/

?>
