<?php 
/*
Similarly to your experience in JS and Python, you can also create Classes using PHP. The syntax is a bit different, but the premise is the same. You can not only create properties that attach to a class instance, but you can also create functions (methods). 

There are a few different operators that we use in PHP that can be confusing. For example, the "->" is used to actually reference a property of an object. Note, when you use this, the propery name does not need a `$` sign in front of it. E.g, `$human->health` will print $health, the `$` operator was not needed.

For example, if a Human class was made with a `health` property, and you had an instance of Human called `my_human`, you could do `my_human->health` to get the value directly.

You can also use $this in your PHP classes, just like you can in JS.

Note that when using classes, there's no usage of the `$` operator, in regards to the *name* of the class. Capitalized like you'd expect.

In PHP classes, we also use CamelCase for Classes, and continue to use snake_case for functions.

IMPORTANT: We also have to use the word `public` befor our variable and functions within our classes, if we wish to access them outside of the class. By default they ARE public, but you can also use `private` to restrict to within the class only, and `protected` to allow the variables to be accessed in any extensions of that class (children or parents).

Here's a full fledged Class example below:
*/

class Human {
  public $health;
  public $clan;
  public $strength = 3; // default value
  public $intelligence = 3;
  public $stealth = 3;
  /*
  PHP has a number of reserved method names that start with two underscores, known as magic methods, that will be called in certain circumstances within a class. The most common one is the __construct() method. The __construct() is a special function within a class that gets called for every new instance of a class. We didn't have to define the __construct() method in our previous implementations of our class. We only have to implement this method if we want to do some kind of custom set-up before the instantiation of an object. 
  */
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
    if($luck * $this->intelligence > 1000) 
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


$myHuman = new Human();

var_dump($myHuman); // Will print Human instance
echo $myHuman->health; // 100
// Also notice `$` not needed when accessing property using `->`

?>