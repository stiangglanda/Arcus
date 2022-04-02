<?php
session_start();
require_once "../classes/user.php";

if (isset($_POST['save'])) {

    // gettin the data from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // creating user object
    $loggedUser = User::validUser($username, $password);
    
    // if the user is valid, redirect to dashboard
    if (!is_null($loggedUser)) {
        $_SESSION['loggedUser'] = $loggedUser;
        header('Location: ../html/dashboard.php');
    }
    // if the user is not valid, redirect to index page
    else {
        header('Location: ../html/signin.php');
    }
}
?>