<?php
include('../sql.php');
session_start();

$_SESSION["email"] = $_POST["email"];

if(empty($_POST["email"])) {
    header("Location: ../index.php?r=1");
    exit;
}

if(empty($_POST["pass"])) {
    header("Location: ../index.php?r=1");
    exit;
}

$email = $mysqli->real_escape_string($_POST["email"]);
$pass = $mysqli->real_escape_string($_POST["pass"]);
$pass = md5($pass);

$query = "SELECT * FROM user WHERE email = '$email'";
$result = $mysqli->query ($query);

if($result) {
    $row = $result->fetch_assoc();
    $name = $row["name"];
    $email = $row["email"];
    $ID = $row["ID"];
    $role = $row["role"];
    if($row["pass"] == $pass) { 
        $_SESSION["loggedin"] = "true";
        $_SESSION["userID"] = $ID;
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["role"] = $role;
        header("Location: ../index.php");
        exit;
    }
}
else {
    header("Location: ../index.php?r=2");
    exit;
}
header("Location: ../index.php?r=2");
exit;
?>