<?php
  function bowl($number_of_bowls = 1) {
    $number_of_pins = array();
    for ($i = 1; $i <= $number_of_bowls; $i++) {
      array_push($number_of_pins, rand(0, 10));
    }
    if ($number_of_bowls == 10) {
      return summarize_game($number_of_pins);
    } else {
      return $number_of_pins;
    }
  }

  function sum($sum, $i) {
    $sum += $i;
    return $sum;
  }

  function summarize_game($pins_per_bowl) {
    $game_summary = array(
      "number_of_games" => 10,
      "pins per bowl" => $pins_per_bowl,
      "total_pins" => array_reduce($pins_per_bowl, "sum")
    );
    return $game_summary;
  }

  print_r(bowl());
  print_r(bowl(10));
?>