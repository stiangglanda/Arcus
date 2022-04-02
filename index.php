<!-- do not touch anything in index-->

<?php
session_start();
$_SESSION['auth'] = false;

if ($_SESSION['auth']) {
    header("location: ./html/dashboard.php");
}
else {
    header("location: ./html/signin.php");
}
?>