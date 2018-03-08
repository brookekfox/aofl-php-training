<?php
  // const PARKING_STRUCTURE_CONFIG = array(
  //   "levels" => array(
  //     0 => array("small" => 13, "regular" => 10),
  //     1 => array("small" => 13, "regular" => 10),
  //     2 => array("small" => 13, "regular" => 10),
  //     3 => array("small" => 13, "regular" => 10),
  //     4 => array("small" => 8, "regular" => 5)
  //   )
  // );
  $PARKING_LOT = array();
  $small_space = array("size" => "small", "reserved" => 0);
  $regular_space = array("size" => "regular", "reserved" => 0);
  $PARKING_LOT_FLOOR = array_merge(
    array_fill(0, 13, $small_space), array_fill(0, 10, $regular_space)
  );
  $PARKING_LOT_FLOOR_5 = array_merge(
    array_fill(0, 8, $small_space), array_fill(0, 5, $regular_space)
  );

  array_push($PARKING_LOT, $PARKING_LOT_FLOOR, $PARKING_LOT_FLOOR, $PARKING_LOT_FLOOR, $PARKING_LOT_FLOOR);
  array_push($PARKING_LOT, $PARKING_LOT_FLOOR_5);

  function can_park($level, $id, $size_of_car, $parking_lot) {
    if (
      $parking_lot == undefined ||
      $parking_lot[$level] == undefined ||
      $parking_lot[$level][$id] == undefined
    ) {
      return "invalid\n";
    }
    if (
      $parking_lot[$level][$id]["reserved"] == 1
    ) {
      echo "parking spot " . $id . " is already reserved\n";
      return $parking_lot;
    } elseif (
      $size_of_car == "regular" && $parking_lot[$level][$id]["size"] == "small"
    ) {
      echo "your car is too big to park in spot " . $id .  "\n";
      return $parking_lot;
    } else {
      $parking_lot[$level][$id]["reserved"] = 1;
      echo "parking is allowed in space " . $id . "\n";
      return $parking_lot;
    }
  }

  // TODO create readable output
  function parking_structure_info($parking_lot) {
    return $parking_lot;
  }

  $parking_lot = can_park(2, 8, "small", $PARKING_LOT); // allowed
  $parking_lot = can_park(2, 7, "regular", $parking_lot); // not allowed
  $parking_lot = can_park(1, 18, "regular", $parking_lot); // allowed
  $parking_lot = can_park(4, 0, "small", $parking_lot); // allowed
  $parking_lot = can_park(4, 0, "small", $parking_lot); // not allowed
  $parking_lot = can_park(3, 4, "regular", $parking_lot); // not allowed
  $parking_lot = can_park(3, 18, "regular", $parking_lot); // allowed
  // print_r(parking_structure_info($parking_lot));

?>