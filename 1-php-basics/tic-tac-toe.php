<?php
  $GRID_1 = array(
    0 => array(1,0,1),
    1 => array(0,1,0),
    2 => array(0,0,1)
  );
  $GRID_2 = array(
    0 => array(0,0,1),
    1 => array(0,1,0),
    2 => array(0,0,1)
  );
  $GRID_3 = array(
    0 => array(0,0,1),
    1 => array(0,0,1),
    2 => array(0,0,1)
  );

  function sum($sum, $i) {
    $sum += $i;
    return $sum;
  }

  function check_rows_and_columns($arr) {
    foreach ($arr as $a) {
      if (array_reduce($a, "sum") == 3) {
        return true;
      }
    }
    return false;
  }

  function check_diagonals($grid) {
    $right = array($grid[0][0], $grid[1][1], $grid[2][2]);
    $left = array($grid[0][2], $grid[1][1], $grid[2][0]);
    return array_reduce($right, "sum") == 3 || array_reduce($left, "sum") == 3;
  }

  function check_game($grid) {
    $columns = array();
    for ($i = 0; $i < 3; $i++) {
      $col = array_column($grid, $i);
      array_push($columns, $col);
    }
    $rows_and_columns = array_merge($grid, $columns);    
    if (check_diagonals($grid) || check_rows_and_columns($rows_and_columns)) {
      return "win\n";
    } else {
      return "lose\n";
    }
  }

  print_r(check_game($GRID_1)); // win
  print_r(check_game($GRID_2)); // lose
  print_r(check_game($GRID_3)); // win

?>