<?php

  function build_deck() {
    $values = array("2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "1");
    $suits  = array("spades", "hearts", "diamonds", "clubs");
    $cards = array();
    foreach ($suits as $suit) {
      foreach ($values as $value) {
        $cards[] = $value;
      }
    }
    shuffle($cards);
    return $cards;
  }

  function play_blackjack($dealer, $player_1, $player_2) {
    $card_number = 0;
    while ($player_1["total"] < 21) {
      $card = $dealer["cards"][$card_number];
      array_push($player_1["cards"], $card);
      $player_1["total"] += $card;
      $card_number++;
    }
    while ($player_2["total"] < 21) {
      $card = $dealer["cards"][$card_number];
      array_push($player_2["cards"], $card);
      $player_2["total"] += $card;
      $card_number++;
    }
    if ($player_1["total"] == $player_2["total"]) {
      echo "draw\n";
      return true;
    } elseif ($player_1["total"] > $player_2["total"]) {
      echo "player 1 wins with " . $player_1["total"] . " points\n";
      return true;
    } elseif ($player_1["total"] < $player_2["total"]) {
      echo "player 2 wins with " . $player_2["total"] . " points\n";
      return true;
    }
  }

  $player_1 = array(
    "cards" => array(),
    "total" => 0
  );

  $player_2 = array(
    "cards" => array(),
    "total" => 0
  );

  $dealer = array(
    "cards" => build_deck()
  );

  play_blackjack($dealer, $player_1, $player_2);

?>