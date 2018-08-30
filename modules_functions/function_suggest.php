<?php
include('../sql.php');
session_start();

$suggest = $mysqli->real_escape_string($_GET["value"]);

$query = "SELECT action FROM report_actions WHERE action LIKE '%".$suggest."%' ORDER BY RAND() LIMIT 1";

$result = $mysqli->query ($query);
    
$i = 0;
while ($row = $result->fetch_assoc()) {
    if($i<$result->num_rows) {
        echo $row["action"];
        $i++;
    }
}
?>