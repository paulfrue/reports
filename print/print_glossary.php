<?php
echo "<div id=\"glossary_title\">Glossar</div><div id=\"glossary_name\">von <i>".$_SESSION["name"]."</i></div><br>";
echo "<b>Vorwort</b><br><br>Im folgenden Glossar sind alle wichtigen Abkürzungen erklärt, 
welche in meinem Berichtsheft erwähnt werden.<br><br><br><br>";
    
$query = "SELECT * FROM glossary WHERE userID = \"".$_SESSION["userID"]."\" AND deleted = 0 ORDER BY category ASC, term";
$result = $mysqli->query ($query);
    
$old_category = 0;
$i = 0;
while ($row = $result->fetch_assoc()) {
    if($i<$result->num_rows) {
        if($row["category"]!=$old_category) {
            $old_category = $row["category"];
            echo "<div class=\"category\">";
            switch ($row["category"]) {
                case 1:
                    echo "Programmiersprachen";
                    break;
                case 2: 
                    echo "Interne Abkürzungen";
                    break;
                case 3: 
                    echo "Kurse";
                    break;
                case 4: 
                    echo "Labs";
                    break;
                case 5: 
                    echo "Räume";
                    break;
                case 6: 
                    echo "Unterrichtsfächer";
                    break;
                case 7: 
                    echo "Hardware";
                    break;
                case 8: 
                    echo "Software";
                    break;
                case 9: 
                    echo "Techniken";
                    break;
                case 10: 
                    echo "Protokolle";
                    break;
                case 11: 
                    echo "Firmen";
                    break;
            }
            echo "</div>";
        }
        echo "<div class=\"term\">".$row["term"]."</div><br>";
        echo "<i><div class=\"description\">".$row["description"]."</div></i><br>";
    
        $i++;
    }
}
exit;
?>