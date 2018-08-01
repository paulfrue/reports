<?php
session_start();
?>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="../style/printstyle.css">
</head>

<div class="print_wrap">
<?php
include ("sql.php");
    
if($_POST["print"] == "glossary") {
    include ("print_glossary.php");
}   
    
if($_POST["print"] == "flane") {    
    include ("print_flane.php");
}
    
if($_POST["print"] == "daily") {
    include ("print_daily.php");
}
?>
</div>