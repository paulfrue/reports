<?php
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "kempah47";
    $dbdata = "flreports";
 
    $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbdata);

    if ($mysqli->connect_errno) {
        printf("Connect failed: %s\n", $mysqli->connect_error);
        exit();
    }

    $mysqli->set_charset("utf8");
?>