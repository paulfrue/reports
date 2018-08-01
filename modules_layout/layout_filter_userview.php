<?php
if(isset($_POST["apprentice"]) & $_SESSION["role"] == "instructor"){
    $_SESSION["userID"] = $_POST["apprentice"];
}

if($_SESSION["role"] == "instructor"){
    $query = "SELECT * FROM user";
    $result = $mysqli->query ($query);
            
    echo "<form method=\"post\" action=\"index.php?apprentice\">";
    echo "<select name=\"apprentice\">";
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        if($i<=$result->num_rows) {
            echo "<option value=".$row["ID"].">".$row["name"]."</option>";
        }
    }
    echo "</select>&nbsp;<input type=\"submit\" class=\"btn\" value=\"Wechseln\"></form><br>";
}            
?>