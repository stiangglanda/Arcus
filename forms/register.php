<?php

$pdo = require '../database/connect.php';

try {
    // get GET records
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $nickName = $_GET['username'];
    $password = $_GET['password'];

    $sql = "INSERT INTO user (firstName, lastName, nickName, password) VALUES (?,?,?,?)";
    $pdo->prepare($sql)->execute([$firstName, $lastName, $nickName, $password]);
    echo "Inserted";
} catch (\Throwable $e) {
    die($e->getMessage());
}
