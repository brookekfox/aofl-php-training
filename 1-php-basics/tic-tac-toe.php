<?php
  // [x, o, x
  //  o, x, o
  //  o, o, x]
  $GRID = array(
    0 => array(1,0,1),
    1 => array(0,1,0),
    2 => array(0,0,1)
  );
  print_r(check_game($GRID));

  function sum($sum, $i) {
    $sum += $i;
    return $sum;
  }

  function check_row_or_column($arr) {
    foreach ($arr as $a) {
      if (array_reduce($a, "sum") == 3) {
        return "win";
      }
    }
  }

  function check_game($grid) {
    // check rows
    check_row_or_column($grid);
    // check diagonals
    $right = array($grid[0][0], $grid[1][1], $grid[2][2]);
    $left = array($grid[0][2], $grid[1][1], $grid[2][0]);
    if (array_reduce($right, "sum") == 3 || array_reduce($left, "sum") == 3) {
      return "win";
    }
    // check columns
    $columns = array();
    for ($i = 0; $i < 3; $i++) {
      $col = array_column($grid, $i);
      array_push($columns, $col);
    }
    check_row_or_column($columns);

    return "lose";
  }

?>