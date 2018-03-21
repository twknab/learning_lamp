<?php  
/*
Create a new class called Bike with the following properties/attributes:

    price
    max_speed
    miles

Create 3 instances of this bike.

Now add a constructor method to the class and require the user to specify the price and max_speed of each instance. In the constructor also specify in the code so that the initial miles is set to be 0 whenever a new instance is created.

Add the following functions for this class:

    displayInfo() - have this method display the bike's price, maximum speed, and the total miles driven.
    drive() - have it display "Driving" on the screen and increase the total miles driven by 10.
    reverse() - have it display "Reversing" on the screen and decrease the total miles driven by 5.

Have the first instance drive three times, reverse once, and have it displayInfo(). 

Have the second instance drive twice, reverse twice, and have it displayInfo(). 

Have the third instance reverse three times and displayInfo().

What would you do to prevent the instance from having negative miles? (added if check statement)
*/

class Bike {
  public $price;
  public $max_speed;
  public $miles = 0;
  public function __construct($price, $max_speed) {
    $this->price = $price;
    $this->max_speed = $max_speed;
  }
  public function displayInfo() {
    echo "***** DISPLAY INFO *****" . "<br/>";
    echo "Price: $" . $this->price . ", Max Speed: " . $this->max_speed . "mph, Miles: " . $this->miles . " miles";
    echo "<br/>************************" . "<br/>";
    return $this;
  }
  public function drive() {
    $this->miles += 10;
    return $this;
  }
  public function reverse() {
    echo "<br/>REVERSING! ....<br/>";
    $this->miles -= 5;
    if ($this->miles < 0) {
      $this->miles = 0;
    }
    return $this;
  }
   
}

$bike1 = new Bike(100, 100);
$bike2 = new Bike(150, 90);
$bike3 = new Bike(250, 110);
var_dump($bike1);
var_dump($bike2);
var_dump($bike3);
$bike1->displayInfo();

$bike1->drive()->drive()->drive()->reverse()->displayInfo();
$bike2->drive()->drive()->reverse()->reverse()->displayInfo();
$bike3->reverse()->reverse()->reverse()->displayInfo();

?>