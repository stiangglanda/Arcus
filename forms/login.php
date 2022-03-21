<?php
// connect to db
try {

    $pdo = require '../database/connect.php';

    // get post records
    $nickName = $_POST['username'];
    $password = $_POST['password'];

    // sql statements
    header("Location: https://google.com/");
    $stmt = $pdo->prepare("SELECT * FROM user");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo $row['nickName'] . $row['password'] . "<br>\n";
    }
} catch (\Throwable $e) {
    die($e->getMessage());
}
?>