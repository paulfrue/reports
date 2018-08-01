<?php
if(isset($_GET["searchtask"])){
    if(empty($_POST["task"])){
        $query = "SELECT * FROM reports WHERE ID = 1";
    }
    else{
        $task_input = $mysqli->real_escape_string(strtolower($_POST["task"]));
                
        $query = "SELECT reportID FROM report_actions WHERE LOWER(action) LIKE LOWER(\"%$task_input%\")";
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
}
?>