<style>
  /* These are styles from this project */
  /* Style the table with a border and no cell-spacing */
  table {
    border: 2px solid #000;
    border-collapse: collapse;
  }
  /* Give zebra striping to every even element */
  tbody tr:nth-child(even) {
     background-color: #ccc;
  }
  /* Give first row bold styling */
  tr:first-child {
    font-weight: bolder;
  }
  /* Give first column bold stying */
  td:first-child {
    font-weight: bolder;
  }
  /* Style all columns */
  td {
    padding: 30px;
    border-top: 2px solid #000;
    border-left: 2px solid #000;
  }
  /* Style empty cell */
  #upper-left {
    padding-right: 35px;
    border-left: none !important;
  }
</style>

<?php
/*
Create a program that displays a multiplication table that looks like the table below:

|   | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 |
| 1 | 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 |
| 2 | 2 | 4 | 6 | 8 | 10| 12| 14| 16| 18|
| 3 | 3 | 6 | 9 | 12| 15| 18| 21| 24| 27|
| 4 | 4 | 8 | 12| 16| 20| 24| 28| 32| 36|
| 5 | 5 | 10| 15| 20| 25| 30| 35| 40| 45|
| 6 | 6 | 12| 18| 24| 30| 36| 42| 48| 54|
| 7 | 7 | 14| 21| 28| 35| 42| 49| 56| 63|
| 8 | 8 | 16| 24| 32| 40| 48| 56| 64| 72|
| 9 | 9 | 18| 27| 36| 45| 54| 63| 72| 81|


Note: Do not put values into arrays.

Display every other row in different background color, with one row in light grey color, the other row in white color. Make the font size of the first row larger and make it bold. Similarly, style the first column so the font is larger and bold. Spend up to 5-10 minutes to make this look pretty using CSS!

Helpful Tips:
A lot of times, it's helpful to create the HTML output first, without using any PHP code. Then review the HTML output to determine where the for loop should be inserted.

This is usually how a real project is created. Front end developers create the HTML/CSS files and, then, backend developers handle the rest. The backend developer gets the HTML/CSS file handled by the front end developer, with some fake data on it. Then, they add scripting languages to generate the desired output. The key lesson is that before you create the output using any dynamic languages like PHP, Ruby, Python, create the final output in plain HTML/CSS first. Then work backwards to see how you could replace some of these output with coding language like PHP.

For example, the final output you want to create looks like below:

<table>
  <tr>
     <td>1x1</td>
     <td>1x2</td>
     <td>1x3</td>
  </tr>
  <tr>
     <td>2x1</td>
     <td>2x2</td>
     <td>2x3</td>
  </tr>
  <tr>
     <td>3x1</td>
     <td>3x2</td>
     <td>3x3</td>
  </tr>
</table>

How would you use PHP to create this output? Try to observe the final output first and check if there is any pattern. On the first pattern, you may observe is that there are three rows and each row has repeated information.  You should know that any repeated information can be replaced with a for loop. So, you may do something like below:

<table>
<?php for($i=0; $i<3; $i++)
      { ?>
      <tr>
         <td><?php echo $i; ?>x1</td>
         <td><?php echo $i; ?>x2</td>
         <td><?php echo $i; ?>x3</td>
      </tr>
<?php } ?>
</table>

Now, do you see anything else that's repeated? Yes! The three columns are being repeated. If you needed to replace this with PHP, how would you do that? You may do something like:

<table>
<?php for($i=1; $i<=3; $i++)
      { ?>
      <tr>
<?php    for($j=1; $j<=3; $j++)
         { ?>
         <td><?php echo $i; ?>x<?php echo $j; ?></td>
<?php    } ?>
      </tr>
<?php } ?>
</table>

Because we created the final desired output in HTML before adding any PHP stuff in it, it was easier to see where  to insert the for loops.

If your PHP interpreter allows short tags (for MAMP, this is enabled by default; although if you're using WAMP, you have to enable this by tweaking your WAMP setting), your final output could look like below:

<table>
<?php for($i=1; $i<=3; $i++)
      { ?>
      <tr>
<?php    for($j=1; $j<=3; $j++)
         { ?>
         <td><?= $i ?>x<?= $j ?></td>
<?php    } ?>
      </tr>
<?php } ?>
</table>

The above code may look a little simpler (where <?= basically means <?php echo). It is up to you which format you want to use. Ruby/Python communities like to use the latter. Although, as a beginner, it would be better to just use the  <?php echo format as you are plainly telling the PHP interpreter to echo out the values as part of HTTP response.
*/


// Let's set some variables so we can later turn this into a function:
$width = 3;
$height = 3;
?>

<table>
  <?php for($i=1; $i<=3; $i++) { ?>
  <tr>
    <?php for($j=1; $j<=3; $j++) { ?>
    <td><?= $i ?>x<?= $j ?></td>
    <?php } ?>
  </tr>
  <?php } ?>
</table>

<!--
Notes: Struggled with this one a bit. I put the whole code snippets into the project to get some direction, but seem to get tripped up a bit with the logic. I'm going to move on for now to keep efficiency. For now, I've got a 3x3 multiplication table setup started, and have the styles in place. I've just got values hard-coded for now above, and the whole thing ideally should be put into a function so we can simply run it, with some width and height arguments, and spit out a mulitplication table.

-->
