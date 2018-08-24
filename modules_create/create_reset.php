<?php
include("../sql.php");
session_start();

if(empty($_POST["rack"]) or empty($_POST["lab"]) or empty($_POST["pod"]) or empty($_POST["date"]) or empty($_POST["time"])){
    header("Location: ../index.php?p=8&r=1");
    exit;
}
else{
    $rack = $mysqli->real_escape_string($_POST["rack"]);
    $lab = $mysqli->real_escape_string($_POST["lab"]);
    $pod = $mysqli->real_escape_string($_POST["pod"]);
    $date = $mysqli->real_escape_string($_POST["date"]);
    $time = $mysqli->real_escape_string($_POST["time"]);
    $comment = $mysqli->real_escape_string($_POST["comment"]);
	
	$date = strtotime($date);
        
    $query = "INSERT INTO resets (ID,userID,rack,lab,pod,date,time,comment) VALUES (Null,\"".$_SESSION["userID"]."\",\"".$rack."\",\"".$lab."\",\"".$pod."\",\"".$date."\",\"".$time."\",\"".$comment."\")";
    $result = $mysqli->query ($query);
}

header("Location: ../index.php?p=8");
exit;
?>