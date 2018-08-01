<?php
include('../sql.php');
session_start();

if($_POST["customdate"] != null) {
    $timestamp = strtotime($_POST["customdate"]);
    $cw = date('W', $timestamp);
}
else {
    $timestamp = time();
    $cw = date('W', time());
}

$tasks = $_POST["tasks"];

if((!$_POST["begin"] or !$_POST["end"]) and (!$_POST["817"] and !$_POST["918"])) {
    header("Location: ../index.php?p=1&r=2");
    exit;
}    
    
if(empty($_POST["action0"]) or empty($_POST["time0"])) {
    header("Location: ../index.php?p=1&r=1");
    exit;
}

if($_POST["817"]) {
    $begin = "8.00";
    $end = "17.00";
}
elseif($_POST["918"]) {
    $begin = "9.00";
    $end = "18.00";
}
else {
    $begin = $_POST["begin"].'';
    $end = $_POST["end"].'';
    $begin = strtr($begin, ":", ".");
    $end = strtr($end, ":", ".");
}

if($_POST["location"] == "company"){
    $query = "INSERT INTO reports (ID,userID,date,cw,location,begin,end,deleted) VALUES (Null,".$_SESSION["userID"].",".$timestamp.",".$cw.",'company',".$begin.",".$end.",0)";
}
if($_POST["location"] == "school"){
    $query = "INSERT INTO reports (ID,userID,date,cw,location,begin,end,deleted) VALUES (Null,".$_SESSION["userID"].",".$timestamp.",".$cw.",'school',".$begin.",".$end.",0)";
}
$result = $mysqli->query ($query);

if($result) {
    $query = "SELECT ID FROM reports ORDER BY ID DESC LIMIT 1";
    $result = $mysqli->query ($query);
    $row = $result->fetch_assoc();
    $reportID = $row["ID"];

    for($i=0; $i<=$tasks; $i++){
        $_SESSION["action".$i] = $_POST["action".$i];
        $action[$i] = $mysqli->real_escape_string($_POST["action".$i]);
        $time[$i] = $mysqli->real_escape_string($_POST["time".$i]);
    
        if(!empty($action[$i]) and !empty($time[$i])) {
            $query = "INSERT INTO report_actions (ID,reportID,action,time) VALUES (Null,'".$reportID."','".$action[$i]."','".$time[$i]."')";
            $result = $mysqli->query ($query);
        }
    }
}
else {
    header("Location: ../index.php?p=1&r=3");
    exit;
}

header("Location: ../index.php");
exit;
?>