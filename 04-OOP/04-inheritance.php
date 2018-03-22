<?php 
/*
Inheritance allows us to take a class and derive a sub-class from it. This sub-class (child class) inherits all the properties from the parent, but may also have additional properties, modified properties, or new or modified methods as well.

Let's start with a class, we'll use the `Human` class again. Once we've setup this class, we'll create 3 child classes.
*/

class Human 
{
  public $health;
  public $clan;
  public $strength = 3;
  public $intelligence = 3;
  public $stealth = 3;

  public function __construct() 
  {
    echo "I am alive";
    $this->health = 100;
  }

  public function __get($property)
  {
    if (property_exists($this, $property))
    {
      return $this->property;
    }
  }

  public function __set($property, $value) 
  {
    if (property_exists($this, $property)) 
    {
      $this->$property = $value;
    }
    return $this;
  }

  public function trashTalk() 
  {
    echo "You want a piece of me?";
  }

  public function attack($human) 
  {
    $this->trashTalk();
    $luck = rand(0, 100);
    if($luck * $this->$intelligence > 1000 && $luck > $human->stealth) 
    {
      $human->health -= $this->strength;
      return true;
    } 
    else
    {
      return false;
    }
  }
}

// Rather than use the word "Child", instead we use the word "extend", followed by the parent class.

// See the 3 classes that we create here below:

class Wizard extends Human
{
    public function heal()
    {
        $this->health += 10;
    }
}

class Ninja extends Human
{
    public function steal()
    {
        $this->stealth += 5;
    }
}

class Samurai extends Human
{
    public function sacrifice()
    {
        $this->health -= 5;
        $this->strength += 10;
    }
}

// creating an instance of Wizard, Ninja and Samurai
$harry = new Wizard();
$rain = new Ninja();
$tom = new Samurai();

// all instances still have human properties because its class extends the Human class
echo $harry->health;
echo $rain->health;
echo $tom->health;

// yet they are subclasses which mean they can extend the current functionality of Human class
// instances of the Wizard class can perform the heal method
$harry->heal();
echo $harry->health;

// instances of the Ninja class can perform the steal method
$rain->steal();
echo $rain->stealth;

// instances of the Samurai class can perform the sacrifice method
$tom->sacrifice();
echo $tom->health;
echo $tom->strength;


// Let's say we wanted to OVERWRITE one of our original methods from the parent class. The way we do this is to actually just simply define a function with the same name within our child function and just overwrite it. Just like so:

class Wizard extends Human
{
    public function heal()
    {
        $this->health += 10;
    }
    public function trashTalk()
    {
        echo "Happiness can be found even in the darkest of times";
    }
}
class Ninja extends Human
{
    public function steal()
    {
        $this->stealth += 5;
    }
    public function trashTalk()
    {
        echo "Now you see me...";
    }
}
class Samurai extends Human
{
    public function sacrifice()
    {
        $this->health -= 5;
        $this->strength += 10;
    }
    public function trashTalk()
    {
        echo "The flower that blooms in adversity is the most beautiful of all";
    }
}

$ron = new Wizard();
$sasuke = new Ninja();
$kenshin = new Samurai();

// all three instances have the method trashTalk which was declared in the Human blueprint which 
// all three of the subclasses extends. However, each subclass overwrote the previous implementation
$ron->trashTalk();
$sasuke->trashTalk();
$kenshin->trashTalk();

// If you want to PRESERVE a function, use the `parent::` operator. For example:

class Warrior extends Human {
  public function trashTalk($human) {
    parent::attack($human);
    return this;
  }
}

// TRASH TALK IS NOW EXTENDED! 


?>