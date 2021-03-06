<?php
include('sql.php');
session_start();
?>

<div id="root_wrap">
    <div class="content_wrap">
        
        <?php
        include ("modules_remove/remove_report.php");
        
        include ("modules_layout/layout_filter_reports.php");
        include ("modules_filter/filter_reports.php");
        include ("modules_filter/filter_reports_overtime.php");
        include ("modules_filter/filter_reports_task.php");
        include ("modules_filter/filter_reports_date.php");
        include ("modules_filter/filter_reports_cw.php");
        include ("modules_filter/filter_reports_default.php");
        
        echo "<div class=\"box\">";
        echo "<h1>Berichtanzeige</h1><hr>";
        
        $result = $mysqli->query ($query);
        
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            if($i<$result->num_rows) {
                $ID[$i] = $row["ID"];
                $date_timestamp[$i] = $row["date"];
                $cw[$i] = $row["cw"];
                $location[$i] = $row["location"];
                $shift[$i] = $row["shift"];
                $begin[$i] = $row["begin"];
                $end[$i] = $row["end"];
    
                $i++;
            }
        }
        
        $size = count($ID);
        
        echo "<div id=\"results\">".$size."&nbsp;Berichte gefunden.</div><br>";
        
        if($size > 0) {
        
        $page_amount = 30;
        $current_page = $_GET["page"];
        
        if($size > $page_amount) {
            $pages = $size/$page_amount;
            echo "Seite:";
            
            for($x = 1; $pages >= $x-1; $x++) {
                if($x == $current_page) {
                    echo "<div class=\"page_number page_number_active\" onclick=\"location.href='index.php?filter=".$_GET["filter"]."&page=".$x."'\">".$x."</div>";
                }
                else {
                    echo "<div class=\"page_number\" onclick=\"location.href='index.php?filter=".$_GET["filter"]."&page=".$x."'\">".$x."</div>";
                }
            }
        }
            
        if($current_page > 1) {
            $page_end = $current_page*$page_amount;
            $page_start = $page_end-$page_amount;
        }
            
        else {
            $page_start = 0;
            $page_end = $page_start+$page_amount;
        }
            
        $cw_old = $cw[$page_start];
        $date_old = date("Y",$date_timestamp[$page_start]);
        
		echo "&nbsp;<hr class=\"view_hr\"><div class=\"hr_cw\" style=\"color: crimson;\">".$date_old."</div></hr><br><br>";
        echo "&nbsp;<hr class=\"view_hr\"><div class=\"hr_cw\">".$cw_old."</div></hr><br><br>";
        
        for($i = $page_start; $i < $page_end and $i < $size; $i++) {
            
			if($date_old != date("Y",$date_timestamp[$i])) {
				$date_old = date("Y",$date_timestamp[$i]);
                echo "&nbsp;<hr class=\"view_hr\"><div class=\"hr_cw\" style=\"color: crimson;\">".$date_old."</div></hr><br><br>";
            }
			
            if($cw_old != $cw[$i]) {
                echo "&nbsp;<hr class=\"view_hr\"><div class=\"hr_cw\">".$cw[$i]."</div></hr><br><br>";
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

            echo "<div class=\"table_wrap\" onmouseover=\"perspectiveChanger(this)\" onmouseout=\"perspectiveReset(this)\">";
            
            echo "<div class=\"table_weekday\"><div class=\"table_weekday_rotate\">".$weekday."</div></div>";
            echo "<div class=\"table_right_wrap\">";
            if($_SESSION["role"] == "apprentice"){
                echo "<div class=\"table_manage\">";
                echo "<img src=\"img/delete.svg\" class=\"manage\" title=\"Report Löschen!\" onclick=\"location.href='index.php?remove&reportID=".$ID[$i]."'\"><br>";
                echo "</div>";
            }
            if($location[$i] == "company" or $location[$i] == "school"){
				if ($total > 8) {
					echo "<div class=\"table_total\"><font color=\"crimson\"><b>".$total."h</b></font></div>";
				}
				elseif ($total < 8) {
					echo "<div class=\"table_total\"><font color=\"navy\">".$total."h</font></div>";
				}
				else {
					echo "<div class=\"table_total\">".$total."h</div>";
				}
            }
            echo "</div>";
            for($it = 0; $it < $iter; $it++) {
                echo "<div class=\"table_task\">";
                switch ($location[$i]){
                    case "company":
                        if($shift[$i] == "day"){
                            $colorodd = "#CCE1E8";
                            $coloreven = "#DCF4FC";
                        }
                        if($shift[$i] == "late"){
                            $colorodd = "#F4F142";
                            $coloreven = "#D1CF2E";
                        }
                        if($shift[$i] == "night"){
                            $colorodd = "#A1F23E";
                            $coloreven = "#87CE31";
                        }
                        
                        if(($it%2) != 1){
                            echo "<div class=\"table_action\" style=\"background-color: ".$colorodd.";\">".$text[$it]."</div><div class=\"table_time\" style=\"background-color: ".$colorodd.";\">".$time[$it]."</div>";
                        }
                        else{
                            echo "<div class=\"table_action\" style=\"background-color: ".$coloreven.";\">".$text[$it]."</div><div class=\"table_time\" style=\"background-color: ".$coloreven.";\">".$time[$it]."</div>";
                        }
                        break;
                    case "school":
                        if(($it%2) != 1){
                            echo "<div class=\"table_action\" style=\"background-color: dodgerblue;\">".$text[$it]."</div><div class=\"table_time\" style=\"background-color: dodgerblue;\">".$time[$it]."</div>";
                        }
                        else{
                            echo "<div class=\"table_action\" style=\"background-color: cornflowerblue;\">".$text[$it]."</div><div class=\"table_time\" style=\"background-color: cornflowerblue;\">".$time[$it]."</div>";
                        }
                        break;
                    case "ill":
                        echo "<div class=\"table_action\" style=\"width: 100%; background-color: #AB5769;\">".$text[$it]."</div>";
                        break;
                    case "vacation":
                        echo "<div class=\"table_action\" style=\"width: 100%; background-color: #D6A881;\">".$text[$it]."</div>";
                        break;
                    case "holiday":
                        echo "<div class=\"table_action\" style=\"width: 100%; background-color: #90D4A4;\">".$text[$it]."</div>";
                        break;
                }
                echo "</div>";
            }
            echo "<div class=\"table_info\">";
            echo "<div class=\"table_date\">".$date."</div>";
            echo "<div class=\"table_cw\">KW:&nbsp;".$cw[$i]."</div>";
            
            if($shift[$i] == "day"){
                $show_shift = "Tagschicht";
            }
            if($shift[$i] == "late"){
                $show_shift = "Spätschicht";
            }
            if($shift[$i] == "night"){
                $show_shift = "Nachtschicht";
            }
            
            switch ($location[$i]){
                case "company":
                    echo "<div class=\"table_location\">Im Unternehmen ".$show_shift."</div>";
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
            
            $weekday = "";
            $total = 0;
            $date  = "";
        }
        }
        
        echo "<font color=\"#404040\">.</font></div>";
        ?>
    </div>
</div>