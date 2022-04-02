<?php
session_start();
$_SESSION['auth'] = false;
header("location: ../index.php");