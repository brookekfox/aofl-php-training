<?php
  $PARKING_LOT = array();
  $PARKING_SPOT_SMALL = array("size" => "small", "reserved" => 0);
  $PARKING_SPOT_REGULAR = array("size" => "regular", "reserved" => 0);
  $PARKING_LOT_FLOOR = array_fill(0, 13, $PARKING_SPOT_SMALL);
  for ($i = 0; $i < 10; $i++) {
    array_push($PARKING_LOT_FLOOR, $PARKING_SPOT_REGULAR);
  }
  $PARKING_LOT_FLOOR_5 = array_fill(0, 8, $PARKING_SPOT_SMALL);
  for ($i = 0; $i < 5; $i++) {
    array_push($PARKING_LOT_FLOOR_5, $PARKING_SPOT_REGULAR);
  }
  array_push($PARKING_LOT, $PARKING_LOT_FLOOR, $PARKING_LOT_FLOOR, $PARKING_LOT_FLOOR, $PARKING_LOT_FLOOR);
  array_push($PARKING_LOT, $PARKING_LOT_FLOOR_5);

  function can_park($level, $id, $size_of_car) {
    global $PARKING_LOT;
    if (
      $PARKING_LOT[$level] == undefined ||
      $PARKING_LOT[$level][$id] == undefined ||
      $PARKING_LOT[$level][$id]["reserved"] == 1 ||
      ($size_of_car == "regular" && $PARKING_LOT[$level][$id]["size"] == "small")
    ) {
      return "parking is not allowed\n";
    } else {
      $PARKING_LOT[$level][$id]["reserved"] = 1;
      return "parking is allowed\n";
    }
  }

  function parking_structure_info() {
    global $PARKING_LOT;
    return $PARKING_LOT;
  }

  print_r(can_park(2, 8, "small")); // allowed
  print_r(can_park(2, 7, "regular")); // not allowed
  print_r(can_park(1, 18, "regular")); // allowed
  print_r(can_park(4, 0, "small")); // allowed
  print_r(can_park(4, 0, "small")); // not allowed
  print_r(can_park(3, 4, "regular")); // not allowed
  print_r(can_park(3, 18, "regular")); // allowed
  print_r(parking_structure_info());

?>