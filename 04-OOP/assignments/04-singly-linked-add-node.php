<?php 

// Node constructor:
Class Node{
 public function __construct($val)
 {
  $this->value = $val;
  $this->next = null;
 }
}

// Sinly Linked List constructor:
Class SinglyLinkedList{
 public function __construct()
 {
  $this->head = null;
  $this->tail = null;
 }

 public function addNode($val) {
  $current = $this->head;
  $newNode = new Node($val);

  if (!$current) {
    $this->head = $newNode;
    return $this;
  }

  while ($current->next) {
    $current = $current->next; // increment
  }

  // Add new node:
  $current->next = $newNode;

  var_dump($current->next);
  return $this;

 }
}

// Create list and some nodes:
$list = new SinglyLinkedList();
$list->head = new Node('Alice');
$list->head->next = new Node('Chad');
$list->head->next->next = new Node('Debra');
var_dump($list);

$list->addNode("Timmah!");




?>