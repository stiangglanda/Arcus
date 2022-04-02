<?php
session_start();

require_once "../classes/db.php";
require_once "../classes/utils.php";
require_once "../classes/user.php";
require_once "../classes/parcour.php";
require_once "../classes/pevent.php";
require_once "../classes/animal.php";
require_once "../classes/score.php";

if (isset($_POST['save'])) {
    $loggedUser = User::validUser($_POST['yourUsername'], $_POST['yourPassword']);
    
    // if the user is valid, redirect to dashboard
    if (!is_null($loggedUser)) {
        $_SESSION['loggedUser'] = $loggedUser;
        header('Location: ../html/dashboard.php');
    }
    // if the user is not valid, redirect to index page
    else {
        header('Location: ../index.php');
    }
}
?>