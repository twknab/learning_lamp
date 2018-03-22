<?php 
class Node {
  public function __construct($val) {
    $this->val = $val;
    $this->next = NULL;
  }
}

class SinglyList {
  public function __current() {
    $this->head = NULL;
    $this->tail = NULL;
  }
  public function printValues() {
    $current = $this->head;

    if (!$current) {
      echo "List is empty.";
      return $this;
    }

    while($current->next) { // loop
      echo $current->val;
      $current = $current->next;
    }

    // On last node:
    echo $current->val;
    return $current;

  }
}

// Create new list:
$list = new SinglyList();

$node1 = new Node(1);
$node2 = new Node(2);
$node3 = new Node(3);

$node1->next = $node2;
$node2->next = $node3;

$list->head = $node1;

$list->printValues();


?>
