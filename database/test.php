<?php
    include 'connection.php';
    $conn = OpenCon();
    echo "Connected Successfully";
    CloseCon($conn);
?>