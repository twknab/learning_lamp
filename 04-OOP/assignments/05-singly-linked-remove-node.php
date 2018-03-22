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
  public function removeVal($value) {
    $current = $this->head;
    $found = FALSE;
    $previous;

    if (!$current) {
      echo "List is empty.";
      return $this;
    }

    while($current->next) { // loop
      if ($current->val === $value) {
        $found = TRUE;
        if (!isset($previous)) {
          // This is head:
          $this->head = $current->next;
          return $this;
        }
        $previous->next = $current->next;
      }
      $previous = $current;
      $current = $current->next;
    }

    // On last node:
    if ($current->val === $value) {
      $found = TRUE;
      if (!isset($previous)) {
        // First and only node detected: 
        $this->head = NULL;
        return $this;
      }
      $previous->next = NULL;
    }

    if (!$found) {
      echo "Value not found.";
      return $this;
    }

    return $this;

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

$list->removeVal(2);
var_dump($list);

$list->removeVal(1);
var_dump($list);

$list->removeVal(3);
var_dump($list);

?>
