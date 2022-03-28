<?php
require_once '../classes/db.php';
require_once '../classes/user.php';
$db = new Database();
$pdo = $db->pdo;
$user = new User();

try {
    listUsers($user::getUsers());

    header("Location:https://www.google.com");
}
catch (Exception $e) {
    die($e->getMessage());
}

function listUsers($users)
{
    foreach ($users as $userObj) {
        echo $userObj->userId . " " . $userObj->firstName . " " . $userObj->lastName . " " . $userObj->nickName . " " . $userObj->password . " " . $userObj->guest . "<br>";
    }
}
