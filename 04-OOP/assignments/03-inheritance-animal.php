<?php 
/*
To Do

Create a class called Animal with the following attributes: name and health. Give the animal following three methods: walk(), run(), and displayHealth(). Give a new animal a health of 100 when it gets created. When a walk method is invoked, have the health decrease by 1. When a run method is involved, have the health decrease by 5. When a displayHealth() method is invoked, display on screen the name of the Animal and the health.

Create an instance of the animal called 'animal' and have this animal walk three times, run twice, and have it display its health.

Now, create another class called Dog that inherits everything that the Animal does and has, but 1) have the default health be 150 and 2) add a new method called pet, which when invoked, increases the health by 5. Have the Dog walk three times, run twice, petted once, and have it display its health.

Now, create another class called Dragon that inherits everything that the Animal has and does, with these two changes: 1) have the default health be 170 and 2) add a new method called fly, which when invoked, decreases the health by 10. Have the Dragon walk three times, run twice, fly twice, and have it display its health. When the Dragon's displayHealth function is called have it say 'this is a dragon!' before it displays the default information (make sure you still call the parent's displayHealth function).

Now for the first instance of Animal (instance called 'animal'), try calling a method 'fly' or 'pet' and make sure it doesn't work. :)
*/

class Animal {
  public $health = 100;
  public $name;
  
  public function __construct($name){
    $this->name = $name;
  }

  public function walk(){
    $this->health -= 1;
    return $this;
  }
  public function run(){
    $this->health -= 5;
    return $this;
  }
  public function displayHealth(){
    echo "</br>****************<br/>";
    echo "Name: " . $this->name . "<br/>";
    echo "Health: " . $this->health . "<br/>";
    echo "****************<br/>";
    return $this;
  }
}

// Create new animal:
$kitter = new Animal("Bubba");
$kitter->walk()->walk()->walk()->run()->run()->displayHealth();
/* Returns:
****************
Name: Bubba
Health: 87
****************
*/

// Now let's create a child class:

class Dog extends Animal {
  public $health = 150;

  public function pet() {
    $this->health += 5;
    return $this;
  }
}

// Create new dog (child of animal):
$doggo = new Dog("Shadow");
echo $doggo->name; // => Shadow
echo "<br/>";

$doggo->walk()->walk()->walk()->run()->run()->pet()->displayHealth();
/*
****************
Name: Shadow
Health: 142
****************
*/

class Dragon extends Animal {
  public $health = 170;

  public function fly() {
    $this->health -= 10;
    return $this;
  }

  public function displayHealth() {
    parent::displayHealth(); // run the original class
    echo "This is a dragon!"; // this will extend the class
    echo "<br/>";
    return $this;
  }
}

$drago = new Dragon("Dracon");
$drago->displayHealth();

$drago->walk()->walk()->walk()->run()->run()->fly()->fly()->displayHealth();
?>