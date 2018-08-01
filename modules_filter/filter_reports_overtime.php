<?php
if(isset($_GET["overtime"])){
    $query = "SELECT reportID FROM report_actions GROUP BY reportID HAVING SUM(time) > 8;";
    $result = $mysqli->query ($query);
                
    if($result){
        $query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND (";
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            if($i<$result->num_rows) {
                if($i<(($result->num_rows)-1)){
                    $query = $query."ID = ".$row["reportID"]." OR ";    
                }
                else{
                    $query = $query."ID = ".$row["reportID"].") ORDER BY date DESC";
                }
                $i++;
            }
        }
    }
}
?>