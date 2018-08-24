<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
            <h1>Neuer Bericht</h1>
            <hr>
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
            <div id="hour_counter">Gesamtstunden:&nbsp;0</div><br>
            <hr>
        <form method="post" action="modules_create/create_report.php">
            Im Unternehmen<input type="radio" id="radio1" name="location" value="company" checked>
            <label for="radio1"></label>
            Berufsschule<input type="radio" id="radio2" name="location" value="school">
            <label for="radio2"></label>
            <br><br>
            Day<input type="radio" id="radio3" name="shift" value="day" checked>
            <label for="radio3"></label>
            Late<input type="radio" id="radio4" name="shift" value="late">
            <label for="radio4"></label>
            Night<input type="radio" id="radio5" name="shift" value="night">
            <label for="radio5"></label>
            <br><br>
            Benutzerdefiniertes Datum:&nbsp;<input type="date" name="customdate">
            <br><br>
            Arbeitsbeginn:&nbsp;<input type="time" name="begin">
            Feierabend:&nbsp;<input type="time" name="end"><br>
            08:00-17:00Uhr<input type="checkbox" id="check1" name="817">
            <label for="check1"></label>
            <br>
            09:00-18:00Uhr<input type="checkbox" id="check2" name="918">
            <label for="check2"></label>
            <br><br>
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
                    echo "Tätigkeit:&nbsp;";
                    echo "<input type=\"text\" id=\"ajax".$i."\" name=\"action".$i."\" style=\"width: 400px;\">";
                    echo "&nbsp;Stunden:&nbsp;";
                    echo "<input class=\"hours\" type=\"text\" name=\"time".$i."\" onkeyup=\"hour_count();\" autocomplete=\"off\">";
                    echo "&nbsp;&nbsp;<img src=\"img/dice.png\" width=\"15px\" height=\"15px\" onclick=\"rand(".$i.");\"><br>";
                }
            ?>
            <br><input type="submit" class="btn" value="Bericht Speichern">
        </form>
        </div>

        <div class="box">
            <form method="post" action="modules_create/create_absent.php">
                <h1>Abwesenheit</h1>
                <hr>
                Benutzerdefiniertes Datum:&nbsp;<input type="date" name="customdate">
                <br><br>
                Krankheit<input type="radio" id="radio6" name="absent" value="ill">
                <label for="radio6"></label>
                Urlaub<input type="radio" id="radio7" name="absent" value="vacation" checked>
                <label for="radio7"></label>
                Feiertag<input type="radio" id="radio8" name="absent" value="holiday">
                <label for="radio8"></label>
                <br><br>
                Grund:&nbsp;
                <input type="text" name="reason" style="width: 300px;" placeholder="Bspw. Krankheit, Urlaub, Feiertag">
                <input type="submit" class="btn" value="Abwesend">
            </form>
        </div>
    </div>
</div>