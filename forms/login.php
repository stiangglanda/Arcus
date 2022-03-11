<?php
// connect to db
try {

    $pdo = require '../database/connect.php';
    // get post records
    $nickName = $_GET['username'];
    $password = $_GET['password'];

    // sql statements

    $stmt = $pdo->prepare("SELECT * FROM user");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo $row['nickname'] . $row['password'] . "<br>\n";
    }
} catch (\Throwable $e) {
    die($e->getMessage());
}
