<?php
include('../sql.php');
session_start();

if(empty($_POST["lesson"]) or empty($_POST["content"]) or empty($_POST["grade"]) or empty($_POST["date"])){
    header("Location: ../index.php?p=7&r=1");
    exit;
}
else{
    $lesson = $mysqli->real_escape_string($_POST["lesson"]);
    $content = $mysqli->real_escape_string($_POST["content"]);
    $grade = $mysqli->real_escape_string($_POST["grade"]);
    $date = $mysqli->real_escape_string($_POST["date"]);
	
	$date = strtotime($date);
    
    $query = "INSERT INTO grades (ID,userID,lesson,content,grade,date) VALUES (Null,\"".$_SESSION["userID"]."\",\"".$lesson."\",\"".$content."\",\"".$grade."\",\"".$date."\")";
    $result = $mysqli->query ($query);
    
    header("Location: ../index.php?p=7");
    exit;
}
?>