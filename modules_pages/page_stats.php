<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
        <h1>Statistiken</h1>
        <hr>
        <?php
            include('sql.php');
            session_start();
            
            $totaldays = 1096;
            echo "Anzahl der Tage als Azubi:&nbsp;<div class=\"red\">".$totaldays."</div><br>";
            
            $totalhours = $totaldays*24;
            echo "Anzahl der Stunden als Azubi:&nbsp;<div class=\"red\">".$totalhours."</div><br>";
            
            echo "Prozent der Ausbildungszeit beendet:&nbsp;<div class=\"red\">".round(((((((time()-1501545600)/60)/60)/24)/$totaldays)*100), 2)."%</div><br><br><hr>";

            $query = "SELECT ID FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0;";
            $result = $mysqli->query ($query);
            $report_count = $result->num_rows;
            echo "Anzahl der Berichte:&nbsp;<div class=\"red\">".$report_count."</div><br>";
        
            $query = "SELECT * FROM reports INNER JOIN report_actions ON reports.ID = report_actions.reportID WHERE userID = ".$_SESSION["userID"]." AND deleted = 0;";
            $result = $mysqli->query ($query);
            $report_action_count = $result->num_rows;
            echo "Anzahl der erledigten Aufgaben:&nbsp;<div class=\"red\">".$report_action_count."</div><br>";
        
            echo "Durchschnittliche Anzahl Aufgaben am Tag:&nbsp;<div class=\"red\">".round(($report_action_count/$report_count), 2)."</div><br>";
        
            $query = "SELECT ID FROM glossary WHERE userID = ".$_SESSION["userID"]." AND deleted = 0;";
            $result = $mysqli->query ($query);
            $glossary_count = $result->num_rows;
            echo "Anzahl der Glossar Einträge:&nbsp;<div class=\"red\">".$glossary_count."</div><br><br>";
            
            $query = "SELECT ID FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'company';";
            $result = $mysqli->query ($query);
            $company_count = $result->num_rows;
            echo "Tage im Betrieb:&nbsp;<div class=\"red\">".$company_count."</div><br>";
        
            $query = "SELECT ID FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'school';";
            $result = $mysqli->query ($query);
            $school_count = $result->num_rows;
            echo "Tage in der Berufsschule:&nbsp;<div class=\"red\">".$school_count."</div><br>";
        
            $query = "SELECT ID FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'vacation';";
            $result = $mysqli->query ($query);
            $vacation_count = $result->num_rows;
            echo "Tage im Urlaub:&nbsp;<div class=\"red\">".$vacation_count."</div><br>";
        
            $query = "SELECT ID FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'holiday';";
            $result = $mysqli->query ($query);
            $holiday_count = $result->num_rows;
            echo "Abwesend wegen Feiertagen:&nbsp;<div class=\"red\">".$holiday_count."</div><br>";
        
            $query = "SELECT ID FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'ill';";
            $result = $mysqli->query ($query);
            $ill_count = $result->num_rows;
            echo "Abwesend wegen Krankheit:&nbsp;<div class=\"red\">".$ill_count."</div><br><br>";
        
            $query = "SELECT date FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 ORDER BY date ASC LIMIT 1;";
            $result = $mysqli->query ($query);
            $mindate = $result->fetch_assoc();
            echo "Aufgezeichnet seit:&nbsp;<div class=\"red\">".date("d.m.Y", $mindate["date"])."</div><br>";
        
            $query = "SELECT date FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 ORDER BY date DESC LIMIT 1;";
            $result = $mysqli->query ($query);
            $maxdate = $result->fetch_assoc();
            echo "Geführt bis:&nbsp;<div class=\"red\">".date("d.m.Y", $maxdate["date"])."</div><br><br>";
        
            echo "Anzahl der Tage:&nbsp;<div class=\"red\">".round((((($maxdate["date"]-$mindate["date"])/60)/60)/24))."</div><br>";
        
            echo "Anzahl der Werktage:&nbsp;<div class=\"red\">".$report_count."</div><br>";
        
            echo "Anzahl der Wochenendtage:&nbsp;<div class=\"red\">".(round((((($maxdate["date"]-$mindate["date"])/60)/60)/24))-$report_count)."</div><br><br>";
        
            $sumhours = round(((($maxdate["date"]-$mindate["date"])/60)/60));
            $sumdays = round((((($maxdate["date"]-$mindate["date"])/60)/60)/24));
            echo "Anzahl der Stunden:&nbsp;<div class=\"red\">".$sumhours."&nbsp;(".round($sumdays, 2)."&nbsp;Tage)</div><br>";
        
            $query = "SELECT SUM(report_actions.time) FROM reports INNER JOIN report_actions ON reports.ID = report_actions.reportID WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND reports.location = 'company';";
            $result = $mysqli->query ($query);
            $hour_count = $result->fetch_row();
            $day_count = $hour_count[0]/24;
            echo "Anzahl der Stunden bei der Arbeit:&nbsp;<div class=\"red\">".$hour_count[0]."&nbsp;(".round($day_count, 2)."&nbsp;Tage)</div><br>";
            
            $query = "SELECT SUM(report_actions.time) FROM reports INNER JOIN report_actions ON reports.ID = report_actions.reportID WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND reports.location = 'school';";
            $result = $mysqli->query ($query);
            $hour_countbs = $result->fetch_row();
            $day_countbs = $hour_countbs[0]/24;
            echo "Anzahl der Stunden in der Berufsschule:&nbsp;<div class=\"red\">".$hour_countbs[0]."&nbsp;(".round($day_countbs, 2)."&nbsp;Tage)</div><br>";
            
            $freetime = (round(((($maxdate["date"]-$mindate["date"])/60)/60))-$hour_count[0]);
            $freetimedays = $freetime/24;
            echo "Anzahl der Stunden Freizeit:&nbsp;<div class=\"red\">".$freetime."&nbsp;(".round($freetimedays, 2)."&nbsp;Tage)</div><br><br>";
        
            $query = "SELECT * FROM report_actions AS rep JOIN reports AS re ON rep.reportID = re.ID WHERE re.userID = ".$_SESSION["userID"]." AND deleted = 0 AND re.location = 'company' OR re.location = 'school' GROUP BY rep.reportID HAVING SUM(rep.time) > 8;";
            $result = $mysqli->query ($query);
            $overtime_count = $result->num_rows;
            echo "Anzahl der Tage mit Überstunden:&nbsp;<div class=\"red\">".$overtime_count."</div><br>";
            
            $query = "SELECT AVG(summe) FROM (SELECT SUM(rep.time)AS summe FROM report_actions AS rep JOIN reports AS re ON rep.reportID = re.ID WHERE re.location = 'company' AND re.userID = ".$_SESSION["userID"]." AND deleted = 0 GROUP BY reportID) report_actions;";
            $result = $mysqli->query ($query);
            $avg_hour = $result->fetch_row();
            echo "Durchschnittliche Arbeitszeit täglich in Stunden:&nbsp;<div class=\"red\">".round($avg_hour[0], 2)."</div><br>";
            
            $query = "SELECT MIN(summe) FROM (SELECT SUM(rep.time)AS summe FROM report_actions AS rep JOIN reports AS re ON rep.reportID = re.ID WHERE re.location = 'company' AND re.userID = ".$_SESSION["userID"]." AND deleted = 0 GROUP BY reportID) report_actions;";
            $result = $mysqli->query ($query);
            $min_hour = $result->fetch_row();
            echo "Kürzeste Arbeitszeit täglich in Stunden:&nbsp;<div class=\"red\">".round($min_hour[0], 2)."</div><br>";
            
            $query = "SELECT MAX(summe) FROM (SELECT SUM(rep.time)AS summe FROM report_actions AS rep JOIN reports AS re ON rep.reportID = re.ID WHERE re.location = 'company' AND re.userID = ".$_SESSION["userID"]." AND deleted = 0 GROUP BY reportID) report_actions;";
            $result = $mysqli->query ($query);
            $max_hour = $result->fetch_row();
            echo "Längste Arbeitszeit täglich in Stunden:&nbsp;<div class=\"red\">".round($max_hour[0], 2)."</div><br>";
            
            $query = "SELECT MIN(begin) FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'company';";
            $result = $mysqli->query ($query);
            $min_begin = $result->fetch_row();
            echo "Frühester Arbeitsbeginn:&nbsp;<div class=\"red\">".$min_begin[0]."</div><br>";
            
            $query = "SELECT MAX(end) FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'company';";
            $result = $mysqli->query ($query);
            $max_end = $result->fetch_row();
            echo "Spätester Feierabend:&nbsp;<div class=\"red\">".$max_end[0]."</div><br>";
            
            $query = "SELECT AVG(begin) FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'company';";
            $result = $mysqli->query ($query);
            $avg_begin = $result->fetch_row();
            echo "Durchschnittlicher Arbeitsbeginn:&nbsp;<div class=\"red\">".round($avg_begin[0], 2)."</div><br>";
            
            $query = "SELECT AVG(end) FROM reports WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 AND location = 'company';";
            $result = $mysqli->query ($query);
            $avg_end = $result->fetch_row();
            echo "Durchschnittlicher Feierabend:&nbsp;<div class=\"red\">".round($avg_end[0], 2)."</div><br><br><hr>";
        
            echo "Worklife Balance:&nbsp;<div class=\"red\">".round((((round(((($maxdate["date"]-$mindate["date"])/60)/60))-$hour_count[0])/((round((($maxdate["date"]-$mindate["date"])/60)/60))))*100), 2)."%</div> Freizeit, <div class=\"red\"> ".round((($hour_count[0]/((round((($maxdate["date"]-$mindate["date"])/60)/60))))*100), 2)."%</div> Arbeit<br><br>";
        
            $freetime_sl = ((round(((($maxdate["date"]-$mindate["date"])/60)/60))-$hour_count[0])-((round((((($maxdate["date"]-$mindate["date"])/60)/60)/24)))*7.5));
            $freetime_slday = $freetime_sl/24;
            echo "Anzahl der Stunden Freizeit abzügl. tägl. 7,5 Stunden Schlaf:&nbsp;<div class=\"red\">".$freetime_sl."&nbsp;(".round($freetime_slday, 2)."&nbsp;Tage)</div><br><br>";
        
            $worktime_base = $sumhours-((round((((($maxdate["date"]-$mindate["date"])/60)/60)/24)))*7.5);
            echo "Worklife Balance abzügl. Schlaf:&nbsp;<div class=\"red\">".round((($freetime_sl/$worktime_base)*100), 2)."%</div> Freizeit, <div class=\"red\">".round((($hour_count[0]/$worktime_base)*100), 2)."%</div> Arbeit<br><br>";
            
            
            $freetime_slt = ((round(((($maxdate["date"]-$mindate["date"])/60)/60))-$hour_count[0])-((round((((($maxdate["date"]-$mindate["date"])/60)/60)/24)))*9.5));
            $freetime_sltday = $freetime_slt/24;
            echo "Anzahl der Stunden Freizeit abzügl. tägl. 7,5 Stunden Schlaf und tägl. 2 Stunden An/-Abreise:&nbsp;<div class=\"red\">".$freetime_slt."&nbsp;(".round($freetime_sltday, 2)."&nbsp;Tage)</div><br><br>";
            
            $worktime_baset = $sumhours-((round((((($maxdate["date"]-$mindate["date"])/60)/60)/24)))*9.5);
            echo "Worklife Balance abzügl. Schlaf und tägl. 2 Stunden An/-Abreise:&nbsp;<div class=\"red\">".round((($freetime_slt/$worktime_baset)*100), 2)."%</div> Freizeit, <div class=\"red\">".round((($hour_count[0]/$worktime_baset)*100), 2)."%</div> Arbeit<br><br>";
            
            $freetime_sltl = ((round(((($maxdate["date"]-$mindate["date"])/60)/60))-$hour_count[0])-((round((((($maxdate["date"]-$mindate["date"])/60)/60)/24)))*10.5));
            $worktime_basetl = $sumhours-((round((((($maxdate["date"]-$mindate["date"])/60)/60)/24)))*10.5);
            echo "Worklife Balance abzügl. Schlaf, tägl. 2 Stunden An/-Abreise, tägl. 1 Stunde Mittagspause:&nbsp;<div class=\"red\">".round((($freetime_sltl/$worktime_basetl)*100), 2)."%</div> Freizeit, <div class=\"red\">".round((($hour_count[0]/$worktime_basetl)*100), 2)."%</div> Arbeit<br><br>";
            
            $freetime_slto = $freetime_sl-$freetime_slt;
            $freetime_sltoday = $freetime_slto/24;
            echo "Anzahl der Stunden Autofahrt bei tägl. 2 Stunden An/-Abreise:&nbsp;<div class=\"red\">".$freetime_slto."&nbsp;(".round($freetime_sltoday, 2)."&nbsp;Tage)</div><br><br>";
            
            echo "Für die Arbeit gefahrene km (18km pro Strecke):&nbsp;<div class=\"red\">".(((($company_count)*18)*2)+((($school_count)*18)*2))."</div><br><br>";
            
        ?>
        </div>
    </div>
</div>