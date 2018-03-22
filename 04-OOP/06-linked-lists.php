<?php 
// Linked lists work similarly in PHP as in all other languages, just have to use the right syntax:

// Create a Node constructor:
Class Node{
 public function __construct($val)
 {
  $this->value = $val;
  $this->next = null;
 }
}

// Create a Sinly Linked List constructor:
Class SinglyLinkedList{
 public function __construct()
 {
  $this->head = null;
  $this->tail = null;
 }
}

// Create a list and some nodes:
$list = new SinglyLinkedList();
$list->head = new Node('Alice');
$list->head->next = new Node('Chad');
$list->head->next->next = new Node('Debra');
var_dump($list);

// Loop through the list like this:
//Set up a variable to keep track of where we are in the list, starting at the first node
$current = $list->head;
// while there is a next node available for us to move to
while($current->next)
{
   echo $current;
   //update the address stored in current to be the address in the current node's next pointer
   $current = $current->next;
}


?>