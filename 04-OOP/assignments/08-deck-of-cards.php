<?php  
class Deck {
  private $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
  private $suites = ["Diamonds", "Hearts", "Spades", "Clubs"];

  public function __construct() {
    $this->__buildDeck();
  }

  private function __buildDeck() {
    $this->cards = array();

    foreach ($this->values as $val) {
      foreach ($this->suites as $suite) {
        array_push($this->cards, ["value" => $val, "suite" => $suite]);
      }
    }
    // var_dump($this->cards); // => Prints all 52 cards
    $this->number_of_cards = count($this->cards);
    return $this;
  }

  public function shuffle() {
    if (!isset($this->cards)) {
      $this->__buildDeck();
    }
    // Shuffle:
    shuffle($this->cards);
    return $this;
  }

  public function reset() {
    $this->__buildDeck();
    return $this;
  }

  public function deal() {
    $max = $this->number_of_cards - 1;
    $index = rand(0, $max); // generates # between 0 and 51 (indexs of first and last card)
    while (!isset($this->cards[$index])) {
      $index = rand(0, $max);
    }
    $card = $this->cards[$index];
    unset($this->cards[$index]); // remove card from array
    $this->number_of_cards = count($this->cards);
    return $card;
  }

}

class Player {
  public function __construct($name, $deck) {
    $this->name = $name;
    $this->hand = $this->getHand($deck);
  }

  public function getHand($deck) {
    $counter = 1;
    $hand = array();
    while ($counter <= 5) {
      array_push($hand, $deck->deal());
      $counter++; 
    }
    return $hand;
  }

  public function draw($deck) {
    if (isset($this->hand)) {
      $card = $deck->deal();
      array_push($this->hand, $card);
      return $this;
    }
    return $this;
  }



  


}

// Create new deck, shuffle, reset, shuffle again.
$newDeck = new Deck;
$newDeck->shuffle();
echo "================= DECK BEFORE SHUFFLE =====================";
var_dump($newDeck->cards);
$newDeck->reset();
echo "=================      DECK RESET     =====================";
var_dump($newDeck->cards);
echo "<br/>... SHUFFLING AND DEALING ...<br/>";
$newDeck->shuffle();
// var_dump($newDeck->deal()); // returns a card associated array

// Create new player:
$tim = new Player("Tim", $newDeck);
// Get a Hand:
echo "=================     PLAYER HAND     =====================";
var_dump($tim->hand);
// echo $newDeck->number_of_cards;

?>