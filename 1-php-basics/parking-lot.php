<?php
  $PARKING_SPOT_SMALL = array("size" => "small", "reserved" => 0);
  $PARKING_SPOT_REGULAR = array("size" => "regular", "reserved" => 0);
  $PARKING_LOT = array_fill(0, 13, $PARKING_SPOT_SMALL);
  for ($i = 0; $i < 10; $i++) {
    array_push($PARKING_LOT, $PARKING_SPOT_REGULAR);
  }

  function can_park($id, $size_of_car) {
    global $PARKING_LOT;
    if (
      $PARKING_LOT[$id] == undefined ||
      $PARKING_LOT[$id]["reserved"] == 1 ||
      ($size_of_car == "regular" && $PARKING_LOT[$id]["size"] == "small")
    ) {
      return "parking is not allowed\n";
    } else {
      $PARKING_LOT[$id]["reserved"] = 1;
      return "parking is allowed\n";
    }
  }

  print_r(can_park(8, "small")); // allowed
  print_r(can_park(18, "regular")); // allowed
  print_r(can_park(22, "small")); // allowed
  print_r(can_park(22, "small")); // not allowed
  print_r(can_park(4, "regular")); // not allowed
  print_r(can_park(4, "small")); // allowed

?>