<?php
if(isset($_GET["searchcw"])){
    $cw_input = $mysqli->real_escape_string($_POST["cw"]);
    $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND cw = \"".$cw_input."\" ORDER BY date DESC";
}
?>