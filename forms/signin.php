<?php
require_once "../classes/db.php";
require_once "../classes/utils.php";
require_once "../classes/user.php";

try {
    $username = $_POST['yourUsername'];
    $password = $_POST['yourPassword'];

    $loggedUser = User::validUser($username, $password);

    if (!is_null($loggedUser)) {
        $_SESSION['auth'] = true;

        $_SESSION['userId'] = $loggedUser->userId;
        $_SESSION['firstName'] = $loggedUser->firstName;
        $_SESSION['lastName'] = $loggedUser->lastName;


        $_SESSION['loggedUser'] = $loggedUser;
        header('Location: ./html/dashboard.php');
    }
    else {
        header('Location: ../index.php');
    }
}
catch (Exception $e) {
    echo $e->getCode() . ': ' . $e->getMessage() . '<br>';
}