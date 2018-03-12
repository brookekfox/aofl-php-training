<?php

  const UPPER_LIMIT = 21;
  const STAY_LIMIT = 17;

  function build_deck() {
    $values = array("2", "3", "4", "5", "6", "7", "8", "9", "10", "10", "10", "10", "1");
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

  function check_game($player_1, $player_2) {
    echo "player 1 received " . $player_1["total"] . " points\n";
    echo "player 2 received " . $player_2["total"] . " points\n";
    if ($player_1["total"] > UPPER_LIMIT) {
      echo "player 1 busts\n";
    }
    if ($player_2["total"] > UPPER_LIMIT) {
      echo "player 2 busts\n";
    }

    if (
      $player_1["total"] <= UPPER_LIMIT &&
      $player_2["total"] <= UPPER_LIMIT &&
      $player_1["total"] == $player_2["total"]
    ) {
      echo "draw\n";
    } else {
      if (
        ($player_1["total"] <= UPPER_LIMIT && $player_1["total"] > $player_2["total"]) ||
        ($player_1["total"] <= UPPER_LIMIT && $player_2["total"] > UPPER_LIMIT)
      ) {
        echo "player 1 wins\n";
        return $player_1;
      }
      if (
        ($player_2["total"] <= UPPER_LIMIT && $player_1["total"] < $player_2["total"]) ||
        ($player_2["total"] <= UPPER_LIMIT && $player_1["total"] > UPPER_LIMIT)
      ) {
        echo "player 2 wins\n";
        return $player_2;
      }
    }
    return false;
  }

  function play_blackjack($dealer, $player_1, $player_2) {
    $card_number = 0;
    while ($player_1["total"] <= STAY_LIMIT) {
      $card = $dealer["cards"][$card_number];
      array_push($player_1["cards"], $card);
      $player_1["total"] += $card;
      $card_number++;
    }
    while ($player_2["total"] <= STAY_LIMIT) {
      $card = $dealer["cards"][$card_number];
      array_push($player_2["cards"], $card);
      $player_2["total"] += $card;
      $card_number++;
    }
    return check_game($player_1, $player_2);
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