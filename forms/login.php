<?php
// connect to db
try {

    $pdo = require 'connect.php';
    // get post records
    $nickName = $_POST['username'];
    $password = $_POST['password'];

    // sql statements

    $stmt = $pdo->prepare("SELECT * FROM users where nickName like ? and password like ?");
    $stmt->execute([$nickName, $password]);
    while ($row = $stmt->fetch()) {
        echo $row['nickname'] . $row['password'] . "<br />\n";
    }
} catch (\Throwable $th) {
    print_r($e->getMessage());
    die($e->getMessage());
}
