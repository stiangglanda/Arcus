<?php
    function OpenCon() {
        $dbhost = "localhost";
        $dbuser = "id18558812_arcus";
        $dbpass = "vrbLW!V?o0-H/(Fk";
        $db = "id18558812_arcusdb";
        $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
        return $conn;
    }

    function CloseCon($conn) {
        $conn->close();
    }
?>