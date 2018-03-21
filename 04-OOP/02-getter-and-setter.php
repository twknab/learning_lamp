<?php 
/*
Similarly to Ruby, PHP uses getter and setter methods. Checkout the arrangement in the Class below.
*/

class MyFirstClass
{
    public $property1 = "I am the first property! Woohoo";
    public function set_property1($property1)
    {
        $this->property1 = $property1;
    }
    public function get_property1()
    {
        return $this->property1;
    }
}
$obj = new MyFirstClass();
echo $obj->get_property1();
$obj->set_property1('New value for property1');
echo $obj->get_property1();


class Human {
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
    if($luck * $this->$intelligence > 1000) 
    {
      if($luck > $human->stealth) 
      {
        $human->health -= $this->strength;
        return true;
      } 
      else 
      {
        return false;
      }
    } 
    else 
    {
        return false;
    }
  }
}

/*
Notice the two new magic methods that we added __get() and __set(). These magic methods are provided to us by PHP so that we don't have to implement our own getters and setters for each property. Now we can get any property by '$obj->property_name' and we can set any property '$obj->property_name = value.' 

It's up to you whether you want to utilize these magic methods or write getters and setters for your property. There are pros and cons of both. Some people claim __get() and __set() are magic and should be avoided. Some people love how it saves more lines of code and makes it more readable. 

This is how the attack method works. An instance of the class Human can execute the attack method and pass in an argument of a human object. It is important that we pass in an instance of a human object because we expect the argument that is passed in to have properties such as $intelligence and $strength. First, the instance of the object is going to execute its trashTalk() method. Then we are going to get a random number from 0 to 100 and store it in a variable called $luck. If $luck multiplied by the instance's intelligence is greater than 1000 AND the luck variable has a greater value than the $human's stealth, we are going to subtract the health of the opposing object by the amount of the current object's strength.
*/
?>