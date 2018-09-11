<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
            <h1>Neuer Bericht</h1>
            <?php
            if(isset($_GET["r"])){
                echo "<div class=\"error\">";
                echo "Fehler!<br>";
                switch ($_GET["r"]){
                    case 1:
                        echo "Mindestens eine Tätigkeit ausfüllen!";
                        break;
                    case 2:
                        echo "Eine Arbeitszeit muss angegeben werden!";
                        break;
                    case 3:
                        echo "Bericht konnte nicht gespeichert werden. Kontaktieren Sie den Administrator.";
                        break;
                    case 4:
                        echo "Ein Abwesenheitsgrund muss angegeben werden!";
                        break;
                }
                echo "</div>";
            }
            
            echo "<div id=\"ajax\"></div>";
            ?>
           
        <form method="post" action="modules_create/create_report.php" autocomplete="off">
            
        <table class="box_table"> 
            <td>Datum (opt.):</td>
            <td colspan="4">Benutzerdefiniertes Datum:&nbsp;<input type="date" name="customdate"></td><tr>
            
            <td>Standort:</td>
            <td colspan="2">Unternehmen&nbsp;<input type="radio" id="radio1" name="location" value="company" checked>
            <label for="radio1" onclick="form_enable_company();"></label></td>
            <td colspan="2">Berufsschule&nbsp;<input type="radio" id="radio2" name="location" value="school">
            <label for="radio2" onclick="form_disable_school();"></label></td><tr>
            
            <tr id="shift">
                <td>Schicht:</td>
                <td  colspan="2">Day&nbsp;<input type="radio" id="radio3" name="shift" value="day" checked>
                <label for="radio3"></label></td>
                <td>Late&nbsp;<input type="radio" id="radio4" name="shift" value="late">
                <label for="radio4"></label></td>
                <td>Night&nbsp;<input type="radio" id="radio5" name="shift" value="night">
                <label for="radio5"></label></td>
            </tr>
            
            <tr id="shift_time">
                <td>Schichtzeiten:</td>
                <td>08:00-17:00&nbsp;<input type="checkbox" id="check1" name="817">
                <label for="check1" onclick="form_disable_check()"></label></td>
                <td>09:00-18:00&nbsp;<input type="checkbox" id="check2" name="918">
                <label for="check2" onclick="form_disable_check()"></label></td>
                <td>16:00-00:00&nbsp;<input type="checkbox" id="check3" name="160">
                <label for="check3" onclick="form_disable_check()"></label></td>
                <td>00:00-08:00&nbsp;<input type="checkbox" id="check4" name="128">
                <label for="check4" onclick="form_disable_check()"></label></td>
            </tr>
            
            <tr id="shift_time_custom">
                <td>Zeiten variabel:</td>
                <td colspan="2">Arbeitsbeginn:&nbsp;<input type="time" name="begin"></td>
                <td colspan="2">Feierabend:&nbsp;<input type="time" name="end"></td>
            </tr>
            
            </table>
            
            <div id="hour_counter">Gesamtstunden:&nbsp;0</div><br>
            
            <table class="box_table">
            
            <?php
                if(isset($_GET["tasks"])){
					$tasks = $_GET["tasks"];
					echo "<input type=\"hidden\" name=\"tasks\" value=".$_GET["tasks"].">";
				}
				else{
					$tasks = 10;
					echo "<input type=\"hidden\" name=\"tasks\" value=\"10\">";
				}
                for($i=0; $i<$tasks; $i++){
                    echo "<td>Tätigkeit:</td>";
                    echo "<td><input type=\"text\" id=\"ajax".$i."\" name=\"action".$i."\" onfocus=\"suggest_clear()\" onkeyup=\"suggest(".$i.",this.value)\" style=\"width: 390px;\"></td>";
                    echo "<td>Stunden:</td>";
                    echo "<td><input class=\"hours\" type=\"text\" name=\"time".$i."\" onkeyup=\"hour_count();\" autocomplete=\"off\"></td><tr>";
                    echo "<div class=\"suggest_box\" id=\"suggest".$i."\" onclick=\"apply_suggest(".$i.")\"></div>";
                }
            ?>
            
            </table>
            
            <br><input type="submit" class="btn" value="Bericht Speichern">
        </form>
        </div>

        <div class="box">
            <form method="post" action="modules_create/create_absent.php">
                <h1>Abwesenheit</h1>
                <table class="box_table">
                    <td>Datum (opt.):</td>
                    <td colspan="3">Benutzerdefiniertes Datum:&nbsp;<input type="date" name="customdate"></td><tr>
                    
                    <td>Grund:</td>
                    <td>Krankheit<input type="radio" id="radio6" name="absent" value="ill">
                    <label for="radio6"></label></td>
                    <td>Urlaub<input type="radio" id="radio7" name="absent" value="vacation" checked>
                    <label for="radio7"></label></td>
                    <td>Feiertag<input type="radio" id="radio8" name="absent" value="holiday">
                    <label for="radio8"></label></td><tr>
                    
                    <td>Kommentar:</td>
                    <td colspan="3"><input type="text" name="reason" style="width: 390px;" placeholder="Bspw. Krankheit, Urlaub, Feiertag"></td><tr>
                </table>
                
                <br><input type="submit" class="btn" value="Abwesend">
            </form>
        </div>
    </div>
</div>