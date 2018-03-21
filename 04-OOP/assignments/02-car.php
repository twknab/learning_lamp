<?php 
/*
Create a class called Car. In the constructor, allow the user to specify the following attributes: price, speed, fuel, mileage. If the price is greater than 10,000, set the tax to be 15%. Otherwise, set the tax to be 12%. 

Create five different instances of the class Car. In the class have a method called Display_all() that returns all the information about the car as a string. In your constructor, call this Display_all() method to display information about the car when a new car is created.

A sample output would be like this:

Price: 2000
Speed: 35mph
Fuel: Full
Mileage: 15mpg
Tax: 0.12

Price: 2000
Speed: 5mph
Fuel: Not Full
Mileage: 105mpg
Tax: 0.12

Price: 2000
Speed: 15mph
Fuel: Kind of Full
Mileage: 95mpg
Tax: 0.12

Price: 2000
Speed: 25mph
Fuel: Full
Mileage: 25mpg
Tax: 0.12

Price: 2000
Speed: 45mph
Fuel: Empty
Mileage: 25mpg
Tax: 0.12

Price: 20000000
Speed: 35mph
Fuel: Empty
Mileage: 15mpg
Tax: 0.15

*/

class Car {
  public $price;
  public $speed;
  public $fuel;
  public $mileage;
  public $tax;

  public function __construct($price, $speed, $fuel, $mileage) {
    $this->price = $price;
    $this->speed = $speed;
    $this->fuel = $fuel;
    $this->mileage = $mileage;

    if ($price > 10000) {
      $this->tax = 0.15;
    } else {
      $this->tax = 0.12;
    }

    $this->displayAll(); // run display all inside constructor
  }

  public function displayAll() {
    echo "<br/>";
    echo "**********************";
    echo "<br/>";
    echo "Price: $" . $this->price . "<br/>";
    echo "Speed: $" . $this->speed . "<br/>";
    echo "Fuel: $" . $this->fuel . "<br/>";
    echo "Mileage: $" . $this->mileage . "<br/>";
    echo "Tax: " . $this->tax * 100 . "%<br/>";
    echo "**********************";
  }

}

$car1 = new Car(15000, 150, 30, 12000);
$car2 = new Car(9000, 120, 32, 22000);
$car3 = new Car(10000, 125, 22, 100000);
$car4 = new Car(50000, 220, 29, 100);
$car4 = new Car(500, 100, 25, 169000);
?>