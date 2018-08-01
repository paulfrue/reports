<?php
include('../sql.php');
session_start();

if(empty($_POST["term"]) or empty($_POST["description"])){
    header("Location: ../index.php?p=5&r=1");
    exit;
}
else{
    $category = $mysqli->real_escape_string($_POST["category"]);
    $term = $mysqli->real_escape_string($_POST["term"]);
    $description = $mysqli->real_escape_string($_POST["description"]);
    
    $query = "INSERT INTO glossary (ID,userID,category,term,description,deleted) VALUES (Null,\"".$_SESSION["userID"]."\",\"".$category."\",\"".$term."\",\"".$description."\",0)";
    $result = $mysqli->query ($query);
    
    header("Location: ../index.php?p=5");
    exit;
}
?>