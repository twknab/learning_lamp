<?php 
/*
If we use the __construct() magic method, this will run with EVERY instantiation of our class. We can also pass variables into the function and do things right off the bat.
*/

// Let's say we wanted the instances of our class to echo out a special message every time it comes to life. We can do this by modifying our previous class implementation to this:

class MyFirstClass
{
    public $property1 = "I am the first property! Woohoo";
    public function __construct()
    {
        echo "I get called for each instance of this class!";
    }
    public function set_property1($property1)
    {
        $this->property1 = $property1;
    }
    public function get_property1()
    {
        return $this->property1;
    }
}
$obj1 = new MyFirstClass(); // runs the __construct function immediately
$obj2 = new MyFirstClass(); // runs the __construct function immediately
echo $obj1->get_property1();
echo $obj2->get_property1();
$obj1->set_property1('New value for property1 for the first instance');
$obj2->set_property1('New value for property1 for the second instance');
echo $obj1->get_property1();
echo $obj2->get_property1();

// We can also pass in variables to the constructor that we pass into the creation of the object.

class MyFirstClass
{
    public $property1 = "I am the first property! Woohoo";
    public function __construct($instance)
    {
        echo "I am getting called for object: ".$instance;
    }
    public function set_property1($property1)
    {
        $this->property1 = $property1;
    }
    public function get_property1()
    {
        return $this->property1;
    }
}
$obj1 = new MyFirstClass('instance one'); // param will be passed into the __construct
$obj2 = new MyFirstClass('instance two'); // param will be passed into the __construct
echo $obj1->get_property1();
echo $obj2->get_property1();
$obj1->set_property1('New value for property1 for the first instance');
$obj2->set_property1('New value for property1 for the second instance');
echo $obj1->get_property1();
echo $obj2->get_property1();
?>