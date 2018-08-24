<head>
<meta charset="utf-8"/>
</head>

<script>
    function replacer(old_string, to_newString){
        var xml_string = document.getElementById("xml_string").value;
        var new_xml_string = xml_string.replace(old_string, to_newString);
        document.getElementById("xml_string").value = new_xml_string;
    }
    function str_search(search){
        var xml_string = document.getElementById("xml_string").value;
        return xml_string.search(search);
    }
    var counter = 1;
    function counter_reset(){
        counter = 1;
    }
    function mark(index, cw) {
        var textareaElement = document.getElementById('mark'+index);
        textareaElement.setAttribute("style", "background-color: lightgreen;");
        var content = textareaElement.innerHTML;
        if(str_search("w"+cw+"_"+counter) == -1){
            counter++;
            replacer("w"+cw+"_"+counter, content);
        }
        else{
            replacer("w"+cw+"_"+counter, content);
        }
    }
    function highlightred(index) {
        var textareaElement = document.getElementById('mark'+index);
        textareaElement.setAttribute("style", "background-color: red;");
    }
    function finish() {
        for(var i=1; i<=53; i++) {
            for(var items=1; items<=7; items++){
                if(str_search("w"+i+"_"+items)){
                    replacer("w"+i+"_"+items, "");
                }
            }
        }
    }
</script>

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
    
            $i++;
        }
    }
        
    $xml_month = date("F", $date_timestamp[0]);
    $xml_year = date("y", $date_timestamp[0]);
    $monthyear = $xml_month." ".$xml_year;
        
    $cw_month[1] = $cw[0];
    $cw_month[2] = $cw[0]+1;
    $cw_month[3] = $cw[0]+2;
    $cw_month[4] = $cw[0]+3;
    $cw_month[5] = $cw[0]+4;
        
    echo "<script>";
    echo "function first_load(){
        replacer(\"?proof_nr\",\"".$proof_number."\");
        replacer(\"?year\",\"".$year_number."\");
        replacer(\"?department\",\"".$department."\");
        replacer(\"?name\",\"".$_SESSION["name"]."\");
        replacer(\"?from\",\"".date("d.m.Y", $date_timestamp[0])."\");
        replacer(\"?to\",\"".date("d.m.Y", $date_timestamp[(($result->num_rows)-1)])."\");
        replacer(\"?monthyear\",\"".$monthyear."\")
        replacer(\"?week1\",\"".$cw_month[1]."\");
        replacer(\"?week2\",\"".$cw_month[2]."\");
        replacer(\"?week3\",\"".$cw_month[3]."\");
        replacer(\"?week4\",\"".$cw_month[4]."\");
        replacer(\"?week5\",\"".$cw_month[5]."\");
        for(var i = 1; i<=5; i++){
            for(var it = 1; it<=7; it++){
                if(i == 1){
                    replacer(\"w1_\"+it, \"w".$cw_month[1]."_\"+it);
                }
                if(i == 2){
                    replacer(\"w2_\"+it, \"w".$cw_month[2]."_\"+it);
                }
                if(i == 3){
                    replacer(\"w3_\"+it, \"w".$cw_month[3]."_\"+it);
                }
                if(i == 4){
                    replacer(\"w4_\"+it, \"w".$cw_month[4]."_\"+it);
                }
                if(i == 5){
                    replacer(\"w5_\"+it, \"w".$cw_month[5]."_\"+it);
                }
            }
        }
    }";
    echo "</script>";
    echo "<input type=\"button\" onclick=\"first_load();\" value=\"First Load XML\">";
    echo "<input type=\"button\" onclick=\"finish();\" value=\"Delete Unwanted Entrys\">";
        
    echo "<h2><u>Ausbildungsnachweis Nr.</u> <b>".$proof_number."</b></h2>";
    echo "<div style=\"text-align: right; position: absolute; width: 50%; left: 50%;\">Ausbildungsjahr: <b>".$year_number."</b></div>";
    echo "<div style=\"text-align: right; position: absolute; width: 50%; left: 50%; top: 45px;\">Abteilung: <b>".$department."</b></div>";
    echo "Vorname, Nachname: <b>".$_SESSION["name"]."</b><br><br>";
    echo "Für die Ausbildungszeit vom <b>".date("d.m.Y", $date_timestamp[0])."</b>";
    echo " bis <b>".date("d.m.Y", $date_timestamp[(($result->num_rows)-1)])."</b><br><br><br>";
        
    echo "<div style=\"font-size: 12;\">Ich führe den Ausbildungsnachweis wöchentlich.</div><br>";
        
    $size = count($ID);
    $action_counter_clp = 0;
    for($i = 0; $i < $size; $i++) {
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
            
        date_default_timezone_set('Europe/Berlin');
        $weekday_number = date("w", $date_timestamp[$i]);
        $date = date("d.m.Y", $date_timestamp[$i]);
            
        for($it = 0; $it < $iter; $it++) {
            echo "<div id=\"mark".$action_counter_clp."\" class=\"table_action\" onClick=\"mark(".$action_counter_clp.", ".$cw[$i].");\">".$text[$it]."</div>";
            echo "<div class=\"flag\" onClick=\"highlightred(".$action_counter_clp.");\"></div>";
            $action_counter_clp++;
        }
            
        if($weekday_number == 5){
            echo "<div class=\"table_action\" style=\"background-color: #909090;\" >*************************".$cw[$i]."*************************";
            echo "<input type=\"button\" onclick=\"counter_reset();\" value=\"Fertig!\"></div>";
        }
            
        $weekday = "";
        $total = 0;
        $date  = "";
    }
        
    echo "<div class=\"table_action\" style=\"background-color: #909090;\" >*************************".$cw[$i]."*************************";
    echo "<input type=\"button\" onclick=\"counter_reset();\" value=\"Fertig!\"></div>";
        
    echo "<br><br><textarea id=\"xml_string\" style=\"width: 100%; height: 600px; font-size: 3; position: fixed; top: 100px; left: calc(100% + 100px);\">";
    include("../print/xml.php");
    echo "</textarea>";
}
else{
    header("Location: index.php?p=4");
    exit;
}
?>