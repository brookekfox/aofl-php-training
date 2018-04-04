CLASS 4 - MYSQL ADVANCED

- mysqli - standard library for mysql
- use `json_encode()`:
  ```php
  private function toApiJsonFormat($arg_success, $arg_result) {
    $result = array(
      "success" => $arg_success,
      "payload" => json_encode($arg_result)
    );
    return json_encode($result);
  }
  ```
- stop sql injection with prepared statements (query with a ? in it, bind a parameter (`bind_param()`) to replace the ?) 

  ```php
  sprintf("hi my name is %s", $name);

  $sql = "SELECT parent_id.name, email"
    . " FROM my_rdb.parent"
    . " WHERE parent_id = ?";
  $statement = $this->runSQL($sql);
  $statement->bind_param("d", $id);
  // with additional ? param
  // $statement->bind_param("dd", $id, $another_id);
  ...
  $id = 1;
  $another_id = 2;
  ...
  $statement->execute();
```
- bind_param() has to happen before the execute
- variable definition has to happen before the execute function but can be after the bind
- compound index on multiple columns
