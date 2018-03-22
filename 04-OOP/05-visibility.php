<?php 
/*
We discussed this earlier in this first lesson, but class properties and methods can have various levels of visibility.

For example, so far we've been using `public` keyword. This opens up our properties and methods to the full public scope, thus, in the global environment there are no restrictions on what we can access or call.
*/

class Monkey {
  public $health = 100;
  public $agility = 150;
  private $secretNumber = 333;

  public function __construct() {
    echo $this->secretNumber; // will ONLY work in this function because this property is PRIVATE
  }
}

$monkey = new Monkey();
//  A new monkey has been created, and because its properties are public, we can access them:

echo $monkey->health; // => 100

// We can also use the keyword `Protected`. The `Protected` keyword limits the scope of properties and methods to WITHIN the class itself or WITHIN child classes:

// Here's an example:

class FlyingMonkey extends Monkey {
  protected $flight = 200;
  public function __construct() {
    $this->displayFlight(); // this function can only be accessed within this file
  }

  protected function displayFlight() {
    echo $this->flight;
    echo $this->secretNumber; // THROWS ERROR, "secretNumber" is PRIVATE and ONLY accessible in parent class
  }
}

$flying_monkey = new FlyingMonkey();
// The flight attribute will be echoed in the __construct() function when the instance is created. However, this function cannot be accessed within the global scope.

// This won't work for example:
$flying_monkey->displayFlight(); // THROWS ERROR



?>