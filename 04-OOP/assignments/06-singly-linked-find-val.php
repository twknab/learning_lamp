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
  public function findVal($value) {
    $current = $this->head;
    $found = FALSE;

    if (!$current) {
      echo "List is empty.";
      return $this;
    }

    while($current->next) { // loop
      if ($current->val === $value) {
        $found = TRUE;
        var_dump($current);
        return $current;
      }
      $current = $current->next;
    }

    // On last node:
    if ($current->val === $value) {
      $found = TRUE;
      var_dump($current);
      return $current;
      
    }

    if (!$found) {
      echo "Value not found.";
      return $this;
    }

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

$list->findVal(2);

$list->findVal(1);

$list->findVal(3);


?>
