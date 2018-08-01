<?php
if(isset($_GET["remove"]) & $_SESSION["role"] == "apprentice"){
    $remove_reportID = $mysqli->real_escape_string($_GET["reportID"]);
    $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND ID = \"".$remove_reportID."\"";
    $result = $mysqli->query ($query);
    
    if($result){
        $query = "UPDATE reports SET deleted = 1 WHERE ID = \"".$remove_reportID."\"";
        $result = $mysqli->query ($query);
        echo "<div class=\"remove\" style=\"background-color: green;\">Report wurde erfolgreich gelöscht!</div>";
    }
    else{
        echo "<div class=\"remove\" style=\"background-color: red;\">Report konnte nicht gelöscht werden!</div>";
    }
}
?>