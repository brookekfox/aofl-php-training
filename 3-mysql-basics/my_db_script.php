<?php


class MyDbScript
{

    private $dbResource = null;

    public function __construct(
        $arg_host,
        $arg_username,
        $arg_password
    ) {
        $this->dbResource = new mysqli($arg_host, $arg_username, $arg_password);
    }

    public function query($arg_query)
    {
        return $this->dbResource->query($arg_query);
    }

    public function fetch_assoc($arg_resource)
    {
        $rows = array();
        while ($row = $arg_resource->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function toJson($arg_data)
    {

        return json_encode($arg_data);
    }

    public function toApiJsonFormat($arg_success, $arg_data)
    {
        $response = array(
            'success' => $arg_success,
            'payload' => $arg_data
        );
        return json_encode($response);
    }
    public function blah ()
    {
        $query = "SELECT parent_id,name,email"
            . " FROM my_rdb.parent"
            . " WHERE parent_id = ?";
    }
    public function getParentsById($arg_ids)
    {
        $sql = "SELECT parent_id,name,email"
            . " FROM my_rdb.parent"
            . " WHERE parent_id = ?";

        $statement = $this->dbResource->prepare($sql);
        $statement->bind_param("d", $id);

        $rows = array();
        foreach ($arg_ids as $id) {

            $statement->execute();
            $result = $statement->get_result();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }

        return $rows;
    }

}

$host = 'localhost';
$username = 'root';
$password = '';

$myDb = new MyDbScript($host, $username, $password);
$result = $myDb->query("SELECT parent_id,name,email FROM my_rdb.parent;");

$myData = $myDb->fetch_assoc($result);
$myData = array(
    'parents' => $myData
);

$myApiResponse = $myDb->toJson($myData);

$myApiResponse = $myDb->toApiJsonFormat('true', $myData);


//---------------------
$myData = $myDb->getParentsById(array(1, 4));
$myData = array(
    'parents' => $myData
);
$myApiResponse = $myDb->toApiJsonFormat('true', $myData);
echo $myApiResponse;

