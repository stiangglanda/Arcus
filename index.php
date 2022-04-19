<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
    header("location: ./html/dashboard.php");
}
else {
    header("location: ./html/signin.php");
}

// require_once "./classes/utils.php";
// Utils::resetDb();
?>