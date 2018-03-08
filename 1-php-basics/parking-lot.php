<?php
  $PARKING_SPOT_SMALL = array("size" => "small", "reserved" => 0);
  $PARKING_SPOT_REGULAR = array("size" => "regular", "reserved" => 0);
  $small_spaces = array_fill(0, 13, $PARKING_SPOT_SMALL);
  $regular_space = array_fill(0, 10, $PARKING_SPOT_REGULAR);
  $PARKING_LOT = array_merge($small_spaces, $regular_space);

  function can_park($id, $size_of_car, $parking_lot) {
    if (
      $parking_lot[$id]["reserved"] == 1
    ) {
      return "parking spot " . $id . " is already reserved\n";
    } elseif (
      $size_of_car == "regular" && $parking_lot[$id]["size"] == "small"
    ) {
      return "your car is too big to park in spot " . $id .  "\n";
    } else {
      $parking_lot[$id]["reserved"] = 1;
      return "parking is allowed in space " . $id . "\n";
    }
  }

  print_r(can_park(8, "small", $PARKING_LOT)); // allowed
  print_r(can_park(18, "regular", $PARKING_LOT)); // allowed
  print_r(can_park(22, "small", $PARKING_LOT)); // allowed
  print_r(can_park(22, "small", $PARKING_LOT)); // not allowed
  print_r(can_park(4, "regular", $PARKING_LOT)); // not allowed
  print_r(can_park(4, "small", $PARKING_LOT)); // allowed

?>