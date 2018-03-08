<?php

  function add_fractions($frac_1, $frac_2) {
    $new_denominator = lcm($frac_1["denom"], $frac_2["denom"]);
    $frac_1_numerator = $frac_1["num"] * ($new_denominator / $frac_1["denom"]);
    $frac_2_numerator = $frac_2["num"] * ($new_denominator / $frac_2["denom"]);
    $new_fraction = reduce_fraction(array(
      "num" => $frac_1_numerator + $frac_2_numerator,
      "denom" => $new_denominator
    ));
    print_r($new_fraction);
    return $new_fraction;
  }

  function reduce_fraction($fraction) {
    $gcd = gcd($fraction["num"], $fraction["denom"]);
    if ($gcd > 1) {
      $fraction["num"] = $fraction["num"] / $gcd;
      $fraction["denom"] = $fraction["denom"] / $gcd;
    }
    return $fraction;
  }

  function lcm($num_1, $num_2) {
    return ($num_1 * $num_2) / gcd($num_1, $num_2);
  }

  function gcd($num_1, $num_2) {
    $remainder = 0;
    while ($num_2 != 0) {
      $remainder = $num_1 % $num_2;
      $num_1 = $num_2;
      $num_2 = $remainder;
    }
    return $num_1;
  }

  $one_half = array("num" => 1, "denom" => 2);
  $three_halves = array("num" => 3, "denom" => 2);
  $one_third = array("num" => 1, "denom" => 3);
  $three_fifths = array("num" => 3, "denom" => 5);
  $nine_fourths = array("num" => 9, "denom" => 4);
  $one_eleventh = array("num" => 1, "denom" => 11);
  $five_sixths = array("num" => 5, "denom" => 6);
  $twentyone_fifteenths = array("num" => 21, "denom" => 15);

  add_fractions($three_fifths, $twentyone_fifteenths); // 30/15 => 2/1
  add_fractions($one_half, $one_third); // 5/6
  add_fractions($three_halves, $nine_fourths); // 15/4
  add_fractions($three_fifths, $one_eleventh); // 38/55
  add_fractions($five_sixths, $twentyone_fifteenths); // 67/30

?>