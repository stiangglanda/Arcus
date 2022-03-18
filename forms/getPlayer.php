<?php
getUser();

function getUser()
{
    try {
        $pdo = require '../database/connect.php';
        echo "start";
        $sql = "SELECT userId, firstName, lastName FROM user";
        $array = array();
        $count = 0;

        foreach ($pdo->query($sql) as $row) {
            echo $count;
            $array += array(
                $count => array(
                    "id" => $row['userId'],
                    "firstname" => $row['firstName'],
                    "lastname" => $row['lastName'],
                    "nickname" => $row['nickName']
                )
            );

            $count++;
        }
        echo "after for";
        // encode array to json
        $json = json_encode(array('data' => $array));
        echo "encoded";
        //write json to file
        if (file_put_contents("data.json", $json))
            echo "JSON file created successfully...";
        else
            echo "Oops! Error creating json file...";
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}
