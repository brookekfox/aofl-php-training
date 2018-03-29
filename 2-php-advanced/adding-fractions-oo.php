<?php
class AddingFractions
{
    public $first;
    public $second;
    public $sum;

    public function __construct($frac_1, $frac_2)
    {
      if ($frac_1["denom"] == 0 || $frac_2["denom"] == 0) {
        throw new Exception("cannot have 0 in the denominator");
      }
      if (
        $frac_1["num"] == null || $frac_1["denom"] == null ||
        $frac_2["denom"] == null
      ) {
        throw new Exception("cannot have 0 in the denominator");
      }
      $new_denominator = $this->lcm($frac_1["denom"], $frac_2["denom"]);
      $frac_1_numerator = $frac_1["num"] * ($new_denominator / $frac_1["denom"]);
      $frac_2_numerator = $frac_2["num"] * ($new_denominator / $frac_2["denom"]);
      $new_fraction = $this->reduce_fraction(array(
        "num" => $frac_1_numerator + $frac_2_numerator,
        "denom" => $new_denominator
      ));
      $this->first = $frac_1;
      $this->second = $frac_2;
      $this->sum = $new_fraction;
    }

    public function __toString() {
      $first_frac = $this->first["num"] . "/" . $this->first["denom"];
      $second_frac = $this->second["num"] . "/" . $this->second["denom"];
      $sum = $this->sum["num"] . "/" . $this->sum["denom"];
      return $first_frac . " + " . $second_frac . " = " . $sum . "\n";
    }

    private function lcm($num_1, $num_2)
    {
      $return = ($num_1 * $num_2) / $this->gcd($num_1, $num_2);
      return $return;
    }

    private function gcd($num_1, $num_2)
    {
      $remainder = 0;
      while ($num_2 != 0) {
        $remainder = $num_1 % $num_2;
        $num_1 = $num_2;
        $num_2 = $remainder;
      }
      return $num_1;
    }

    private function reduce_fraction($fraction)
    {
      $gcd = $this->gcd($fraction["num"], $fraction["denom"]);
      if ($gcd > 1) {
        $fraction["num"] = $fraction["num"] / $gcd;
        $fraction["denom"] = $fraction["denom"] / $gcd;
      }
      return $fraction;
    }
}

// -------------------------------- tests --------------------------------------
$one_half = array("num" => 1, "denom" => 2);
$three_halves = array("num" => 3, "denom" => 2);
$one_third = array("num" => 1, "denom" => 3);
$three_fifths = array("num" => 3, "denom" => 5);
$nine_fourths = array("num" => 9, "denom" => 4);
$one_eleventh = array("num" => 1, "denom" => 11);
$five_sixths = array("num" => 5, "denom" => 6);
$twentyone_fifteenths = array("num" => 21, "denom" => 15);
$bad = array("num" => 1, "denom" => 0);

echo new AddingFractions(
  $three_fifths, $twentyone_fifteenths
);
echo new AddingFractions(
  $one_half, $one_third
);
echo new AddingFractions(
  $three_halves, $nine_fourths
);
echo new AddingFractions(
  $three_fifths, $one_eleventh
);
echo new AddingFractions(
  $five_sixths, $twentyone_fifteenths
);
echo new AddingFractions(
  $one_half, $bad
);
// -------------------------------- tests --------------------------------------

?>