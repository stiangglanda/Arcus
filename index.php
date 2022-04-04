<!-- do not touch anything in index-->

<?php
session_start();
$_SESSION['auth'] = false;

if (isset($_SESSION['auth']) && $_SESSION['auth'] == true) {
    header("location: ./html/dashboard.php");
}
else {
    header("location: ./html/signin.php");
}
?>