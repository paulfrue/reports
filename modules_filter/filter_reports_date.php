<?php
if(isset($_GET["searchdate"])){
    $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0";
    $result = $mysqli->query ($query);
                
    $date_input = $mysqli->real_escape_string($_POST["date"]);
                
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        if($i<$result->num_rows) {
            $date_formatted = date("d.m.Y", $row["date"]);
            if($date_formatted == $date_input){
                $reportID = $row["ID"];
            }
            $i++;
        }
    }           
    $query = "SELECT * FROM reports WHERE ID = '$reportID'";   
}
?>