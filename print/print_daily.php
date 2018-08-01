<?php
if(empty($_POST["month"]) or empty($_POST["year"]) or empty($_POST["proof_number"]) or empty($_POST["year_number"]) or empty($_POST["department"])){
    header("Location: index.php?p=4");
    exit;
}

$month = $mysqli->real_escape_string($_POST["month"]);
$year = $mysqli->real_escape_string($_POST["year"]);
$proof_number = $mysqli->real_escape_string($_POST["proof_number"]);
$year_number = $mysqli->real_escape_string($_POST["year_number"]);
$department = $mysqli->real_escape_string($_POST["department"]);

$query = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0";
$result = $mysqli->query ($query);

$query_new = "SELECT * FROM reports WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 AND ";
$i = 0;
while ($row = $result->fetch_assoc()) {
    if($i<$result->num_rows) {
        if($year == date("Y", $row["date"]) and $month == date("n", $row["date"])){
            $query_new = $query_new."ID = ".$row["ID"]." OR "; 
        }
        $i++;
    }
}
$query_new = $query_new." date = 1 ORDER BY date ASC";

$result = $mysqli->query ($query_new);

if($result){    
    $i = 0;
    while ($row = $result->fetch_assoc()) {
        if($i<$result->num_rows) {
            $ID[$i] = $row["ID"];
            $date_timestamp[$i] = $row["date"];
            $cw[$i] = $row["cw"];
            $location[$i] = $row["location"];
            $begin[$i] = $row["begin"];
            $end[$i] = $row["end"];
    
            $i++;
        }
    }
    
    $size = count($ID);
    $cw_old = $cw[0];
        
    echo "<h2><u>Ausbildungsnachweis Nr.</u> <b>".$proof_number."</b></h2>";
    echo "<div style=\"text-align: right; position: absolute; width: 50%; left: 50%;\">Ausbildungsjahr: <b>".$year_number."</b></div>";
    echo "<div style=\"text-align: right; position: absolute; width: 50%; left: 50%; top: 45px;\">Abteilung: <b>".$department."</b></div>";
    echo "Name, Vorname: <b>".$_SESSION["name"]."</b><br><br>";
    echo "Für die Ausbildungszeit vom <b>".date("d.m.Y", $date_timestamp[0])."</b>";
    echo " bis <b>".date("d.m.Y", $date_timestamp[(($result->num_rows)-1)])."</b><br><br><br>";
        
    echo "<div style=\"font-size: 12;\">Ich führe den Ausbildungsnachweis täglich.</div><br>";
    
    echo "&nbsp;<hr class=\"view_hr\"><div class=\"hr_cw\">KW ".$cw_old."</div></hr><br><br>";
    
    echo "<div id=\"legend\">";
    echo "<div id=\"tag\">Tag</div>";
    echo "<div id=\"taetigkeit\">Beschreibung der Ausbildungsinhalte (ausgeführte Arbeiten, Themen der Unterweisung oder des Unterrichts)</div>";
    echo "<div id=\"zeit\">Zeit</div>";
    echo "<div id=\"gesamt\">Gesamt</div>";
    echo "</div>";
    
    for($i = 0; $i < $size; $i++) {
        if($cw_old != $cw[$i]) {
            echo "&nbsp;<hr class=\"view_hr\"><div class=\"hr_cw\">KW ".$cw[$i]."</div></hr><br><br>";
            $cw_old = $cw[$i];
        }
        
        $query = "SELECT * FROM report_actions WHERE reportID = '$ID[$i]'";
        $result = $mysqli->query ($query);
                
        $iter = 0;
        while ($row = $result->fetch_assoc()) {
            if($iter<$result->num_rows) {
                $text[$iter] = $row["action"];
                $time[$iter] = $row["time"];
                $total = $total + $time[$iter];
                        
                $iter++;
            }
        }
            
        $days = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
        date_default_timezone_set('Europe/Berlin');
        $weekday_number = date("w", $date_timestamp[$i]);
        $weekday_text = $days[$weekday_number];
        for($we = 0; $we < strlen($weekday_text); $we++) {
            $weekday = $weekday . $weekday_text[$we];
        }
            
        $date = date("d.m.Y", $date_timestamp[$i]);
            
        echo "<div class=\"table_wrap\">";   
        echo "<div class=\"table_weekday\"><div class=\"table_weekday_rotate\">$weekday</div></div>";
        echo "<div class=\"table_right_wrap\">";
        if($location[$i] == "company" or $location[$i] == "school"){
            echo "<div class=\"table_total\">".$total."h</div>";
        }
        echo "</div>";
        for($it = 0; $it < $iter; $it++) {
            echo "<div class=\"table_task\">";
            switch ($location[$i]){
                case "company":
                    echo "<div class=\"table_action\" style=\"background-color: rgba(0,0,0,0.07);\">".$text[$it]."</div><div class=\"table_time\" style=\"background-color: rgba(0,0,0,0.15);\">".$time[$it]."</div>";
                    break;
                case "school":
                    echo "<div class=\"table_action\" style=\"background-color: rgba(0,0,0,0.07);\">".$text[$it]."</div><div class=\"table_time\" style=\"background-color: rgba(0,0,0,0.15);\">".$time[$it]."</div>";
                    break;
                case "ill":
                    echo "<div class=\"table_action\" style=\"width: 100%; background-color: rgba(0,0,0,0.07);\">".$text[$it]."</div>";
                    break;
                case "vacation":
                    echo "<div class=\"table_action\" style=\"width: 100%; background-color: rgba(0,0,0,0.07);\">".$text[$it]."</div>";
                    break;
                case "holiday":
                    echo "<div class=\"table_action\" style=\"width: 100%; background-color: rgba(0,0,0,0.07);\">".$text[$it]."</div>";
                    break;
            }
            echo "</div>";
        }
        echo "<div class=\"table_info\">";
        echo "<div class=\"table_date\">".$date."</div>";
        echo "<div class=\"table_cw\">KW:&nbsp;".$cw[$i]."</div>";
        switch ($location[$i]){
            case "company":
                echo "<div class=\"table_location\">Im Unternehmen</div>";
                echo "<div class=\"table_worktime\">".$begin[$i]." bis ".$end[$i]." Uhr</div>";
                break;
            case "school":
                echo "<div class=\"table_location\">In der Berufsschule</div>";
                echo "<div class=\"table_worktime\">".$begin[$i]." bis ".$end[$i]." Uhr</div>";
                break;
            case "ill":
                echo "<div class=\"table_location\">Krankheit</div>";
                break;
            case "vacation":
                echo "<div class=\"table_location\">Im Urlaub</div>";
                break;
            case "holiday":
                echo "<div class=\"table_location\">Feiertag</div>";
                break;
        }
        echo "</div>";
        echo "</div>";
        
        if($weekday == "Freitag"){
            echo "<p></p>";
        }
            
        $weekday = "";
        $total = 0;
        $date  = "";
    }
      
    echo "<div class=\"sign\">Datum und Unterschrift des Auszubildenden</div>";
    echo "<div class=\"sign\">Datum und Unterschrift des Ausbildenden</div>";
        
}
else{
    header("Location: index.php?p=4");
    exit;
}
?>