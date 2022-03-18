<?php
try {
    $pdo = require '../database/connect.php';
    $sql = "SELECT userId, firstName, lastName FROM user";
    $array = array();
    $count = 0;

    // save result rows to array
    foreach ($pdo->query($sql) as $row) {
        $array += array(
            $count => array(
                "userId" => $row['userId'], // int
                "firstName" => $row['firstName'], // string
                "lastName" => $row['lastName'], // string
                "nickName" => $row['nickName'], // string
                "password" => $row['password'], // string
                "guest" => $row['guest'] // bool (0 = no guest, 1 = guest)
            )
        );

        $count++;
    }

    // encode array to json
    $json = json_encode(array('data' => $array));

    //write json to file
    if (!file_put_contents("data.json", $json)) {
        echo "Oops! Error creating json file...";
    }
} catch (\Throwable $e) {
    die($e->getMessage());
}
