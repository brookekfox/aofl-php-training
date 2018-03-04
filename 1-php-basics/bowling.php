<?php
  print_r(bowl($argv[1]));

  function bowl($number_of_bowls = 1) {
    $number_of_pins = array();
    for ($i = 1; $i <= $number_of_bowls; $i++) {
      array_push($number_of_pins, random_bowl());
    }
    if ($number_of_bowls == 10) {
      return summarize_game($number_of_pins);
    } else {
      return $number_of_pins;
    }
  }

  function random_bowl() {
    return rand(0, 10);
  }

  function sum($total, $i) {
    $total += $i;
    return $total;
  }

  function summarize_game($pins_per_bowl) {
    $game_summary = array(
      "number_of_games" => 10,
      "pins per bowl" => $pins_per_bowl,
      "total_pins" => array_reduce($pins_per_bowl, "sum")
    );
    return $game_summary;
  }
?>