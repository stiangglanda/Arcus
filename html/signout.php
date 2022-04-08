<?php
session_start();
$_SESSION['logged'] = false;
header("location: ../index.php");