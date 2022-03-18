<?php

function getUser()
{
    $pdo = require '../database/connect.php';

    try {
        // get GET records
        // $firstName = $_POST['firstName'];
        // $lastName = $_POST['secondName'];
        // $nickName = $_POST['nickName'];

        // $sql = "INSERT INTO user (firstName, lastName, nickName, password) VALUES (?,?,?,?)";
        // $pdo->prepare($sql)->execute([$firstName, $lastName, $nickName, 'test']);

        $sql = "SELECT userId, firstName, lastName FROM user";

        foreach ($pdo->query($sql) as $row) {
            echo $row['firstName'] . " ";
            echo $row['lastName'] . " ";
            echo $row['userId'] . "<br>";
        }
    } catch (\Throwable $e) {
        die($e->getMessage());
    }
}
