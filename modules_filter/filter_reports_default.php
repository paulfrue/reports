<?php
if(!isset($_GET["searchtask"]) and !isset($_GET["searchdate"]) and !isset($_GET["searchcw"]) and !isset($_GET["overtime"]) and !isset($_GET["filter"])){
    $cwdate = date('W', time())."";
    $cwdate = (int) $cwdate;
    $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND cw = \"".$cwdate."\" ORDER BY date DESC";
}
?>