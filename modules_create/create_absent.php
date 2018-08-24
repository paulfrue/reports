<?php
include ("../sql.php");
session_start();

if($_POST["customdate"] != null) {
    $timestamp = strtotime($_POST["customdate"]);
    $cw = date('W', $timestamp);
}
else {
    $timestamp = time();
    $cw = date('W', time());
}

if(!$_POST["absent"]) {
    header("Location: ../index.php?p=1&r=4");
    exit;
}
    
$reason = $mysqli->real_escape_string($_POST["reason"]);

if($_POST["absent"] == "ill"){
    $query = "INSERT INTO reports (ID,userID,date,cw,location,shift,begin,end,deleted) VALUES (Null,".$_SESSION["userID"].",".$timestamp.",".$cw.",'ill',0,0,0,0)";
    $result = $mysqli->query ($query);
}
if($_POST["absent"] == "vacation"){
    $query = "INSERT INTO reports (ID,userID,date,cw,location,shift,begin,end,deleted) VALUES (Null,".$_SESSION["userID"].",".$timestamp.",".$cw.",'vacation',0,0,0,0)";
    $result = $mysqli->query ($query);
}
if($_POST["absent"] == "holiday"){
    $query = "INSERT INTO reports (ID,userID,date,cw,location,shift,begin,end,deleted) VALUES (Null,".$_SESSION["userID"].",".$timestamp.",".$cw.",'holiday',0,0,0,0)";
    $result = $mysqli->query ($query);
}
    
if($result) {
    $query = "SELECT ID FROM reports ORDER BY ID DESC LIMIT 1";
    $result = $mysqli->query ($query);
    $row = $result->fetch_assoc();
    $reportID = $row["ID"];
    
    $query = "INSERT INTO report_actions (ID,reportID,action,time) VALUES   (Null,'".$reportID."','".$reason."',0)";
    $result = $mysqli->query ($query);
}
    
header("Location: ../index.php");
exit;
?>