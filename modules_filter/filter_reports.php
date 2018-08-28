<?php
if($_GET["filter"]){
    switch($_GET["filter"]){
        case "all":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 ORDER BY date DESC";
            break;
        case "lastfive":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 ORDER BY date DESC LIMIT 5";
            break;
        case "lastthirty":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 ORDER BY date DESC LIMIT 30";
            break;
        case "school":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND location = 'school' ORDER BY date DESC";
            break;
        case "ill":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND location = 'ill' ORDER BY date DESC";
            break;
        case "vacation":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND location = 'vacation' ORDER BY date DESC";
            break;
        case "holiday":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND location = 'holiday' ORDER BY date DESC";
            break;
        case "late":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND shift = 'late' ORDER BY date DESC";
            break;
        case "night":
            $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND shift = 'night' ORDER BY date DESC";
            break;
    }
}
?>