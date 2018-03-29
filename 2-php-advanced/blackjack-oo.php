<?php
class Deck
{
  public $cards = array();
  public $suits = array("spades", "hearts", "diamonds", "clubs");
  public $values = array(
    "2" => "2",
    "3" => "3",
    "4" => "4",
    "5" => "5",
    "6" => "6",
    "7" => "7",
    "8" => "8",
    "9" => "9",
    "10" => "10",
    "J" => "10",
    "Q" => "10",
    "K" => "10",
    "A" => "1"
  );

  public function __construct($shuffle = true)
  {
    $cards = array();
    foreach ($this->suits as $suit) {
      foreach ($this->values as $type => $value) {
        array_push($cards, array(
          "suit" => $suit,
          "type" => $type,
          "value" => $value
        ));
      }
    }
    if ($shuffle) {
      shuffle($cards);
    }
    $this->cards = $cards;
  }
}

class Player
{
  public $hand;
  public $score;
  public $bust;
  public $name;

  public function __construct($name)
  {
    $this->name = $name;
    $this->hand = array();
    $this->score = 0;
    $this->bust = false;
  }

  public function hit($card)
  {
    array_push($this->hand, $card);
    $this->calculateScore();
  }

  private function calculateScore()
  {
    $current_score = 0;
    $values = array_column($this->hand, "value");
    asort($values);
    $current_score = array_sum($values);
    $index_of_ace = array_search("A", array_column($this->hand, "type"));
    if ($index_of_ace) {
      if ($current_score + 10 > 16 && $current_score + 10 <= 21) {
        $this->hand[$index_of_ace]["value"] = 11;
        $current_score += 10;
      } elseif ($current_score - 10 > 16 && $current_score - 10 <= 21) {
        $this->hand[$index_of_ace]["value"] = 1;
        $current_score -= 10;
      }
    }
    if ($current_score > 21) {
      $this->bust = true;
    }
    $this->score = $current_score;
  }

  public function displayHand()
  {
    $return = "";
    foreach ($this->hand as $card) {
      $return .= $card["type"] . " " . $card["suit"] . " ";
    }
    return $return;
  }

  public function __toString()
  {
    return "current score for " . $this->name . ": " . $this->score . ".\n";
  }
}

class Blackjack
{
  public $players;
  public $deck;
  private $card_number = 0;
  private $winner;

  public function __construct($players, $deck)
  {
    $this->players = $players;
    $this->deck = $deck;
    $this->dealTwoCardsEach();
    foreach($this->players as $player) {
      $this->takeATurn($player);
    }
    $this->winner = $this->determineWinner();
  }

  private function dealTwoCardsEach()
  {
    foreach($this->players as $player) {
      $player->hit($this->deck[$this->card_number]);
      $this->card_number++;
      $player->hit($this->deck[$this->card_number]);
      $this->card_number++;
    }
  }

  private function takeATurn($player)
  {
    $upper_hit_limit = 16;
    while ($player->score <= $upper_hit_limit) {
      $player->hit($this->deck[$this->card_number]);
      $this->card_number++;
    }
    return true;
  }

  private function cmp($a, $b)
  {
    return $b->score > $a->score;
  }

  private function filterOutBusts($a)
  {
    return !$a->bust;
  }

  private function determineWinner()
  {
    $players = array_filter($this->players, array($this, "filterOutBusts"));
    usort($players, array($this, "cmp"));
    return $players[0];
  }

  public function __toString()
  {
    $return = "";
    foreach ($this->players as $player) {
      $return .=
        "========================\n" . $player->name . "\n------------\n" .
        "final score: " . $player->score .
        "\nhand: " . $player->displayHand() .
        "\n========================\n";
    }
    $return .=
      "The winner is " .
      $this->winner->name . " with " .
      $this->winner->score . " points!\n";
    return $return;
  }
}

// -------------------------------- tests --------------------------------------
$deck = new Deck();
$players = array(
  new Player("Brooke"),
  new Player("Mike"),
  new Player("Tina"),
  new Player("Lizzie")
);
echo new Blackjack($players, $deck->cards);
// -------------------------------- tests --------------------------------------

?>