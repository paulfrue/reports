<?php
include('sql.php');
session_start();

$query = "SELECT * FROM resets WHERE userID = ".$_SESSION["userID"]." ORDER BY date DESC";
$result = $mysqli->query ($query);
?>

<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
        <form method="post" action="modules_create/create_reset.php">
            <h1>Lab Resets eintragen</h1>
            <hr>
            <?php
            if(isset($_GET["r"])){
                echo "<div class=\"error\">";
                echo "Fehler!<br>";
                switch ($_GET["r"]){
                    case 1:
                        echo "Die Felder dürfen nicht leer sein!";
                        break;
                }
                echo "</div>";
            }
            ?>
            Racknummer:&nbsp;<input type="text" name="rack">&nbsp;
            Zeitpunkt:&nbsp;<input type="datetime-local" name="date"><br><br>
            Labname:&nbsp;<input type="text" name="lab">
            &nbsp;Pod:&nbsp;<input type="text" name="pod">
            <br><br>
            Zeitaufwand:&nbsp;<input type="text" name="time" style="width: 50px;">
            <br><br>
            Kommentar (opt.):&nbsp;<input type="text" name="comment" style="width: 400px;">
            <br><br>
            <input type="submit" class="btn" value="Reset speichern">
        </form>
        </div>
        <div class="box">
            <h1>Lab Resets</h1>
            <hr>
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                if($i<$result->num_rows) {
                    echo "<div class=\"term\">".$row["lab"]."&nbsp&nbsp;<font color=\"grey\">".$row["rack"]."</font></div>";
                    echo "<div class=\"description\">Pod: <font color=\"crimson\"><b>".$row["pod"]."</b></font><br>
                    Zeitpunkt: <font color=\"crimson\"><b>".date("d.m.Y H:i", $row["date"])."</b></font><br>
                    Zeitaufwand: <font color=\"crimson\"><b>".$row["time"]."</b></font>&nbsp;Stunden";
                    if(!empty($row["comment"])) {
                        echo "<br>Kommentar: <font color=\"crimson\"><b>".$row["comment"]."</b></font>";
                    }
                    echo "</div>";
                    $i++;
                }
            }
            ?>
        </div>
    </div>
</div>