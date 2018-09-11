<?php
include('sql.php');
session_start();

$query = "SELECT * FROM grades WHERE userID = ".$_SESSION["userID"]." ORDER BY date DESC, lesson";
$result = $mysqli->query ($query);
?>

<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
        <form method="post" action="modules_create/create_grade.php">
            <h1>Berufsschulnoten eintragen</h1>
            
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
        <table class="box_table">
            <td>Datum:</td><td><input type="date" name="date"></td><tr>
            <td>Unterrichtsfach:</td>
            <td>
            <select name="lesson">
                <option value="AE-M">AE-M</option>
                <option value="OGP">OGP</option>
                <option value="FE-M">FE-WS</option>
                <option value="SuK">SuK</option>
                <option value="IT-WS">IT-WS</option>
                <option value="IT-M">IT-M</option>
                <option value="SuG">GuS</option>
                <option value="Projekt01">Projekt01</option>
            </select>
            </td><tr>
            <td>Thema:</td><td><input type="text" name="content" style="width: 400px;"></td><tr>
            <td>Note:</td><td><input type="text" name="grade" style="width: 100px;"></td><tr>
        </table>
            <input type="submit" class="btn" value="Note speichern">
        </form>
        </div>
        <div class="box">
            <h1>Berufsschulnoten</h1>
            <hr>
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                if($i<$result->num_rows) {
                    echo "<div class=\"term\">".$row["lesson"]."&nbsp&nbsp;<font color=\"grey\">".$cw = date('d.m.y', $row["date"])."</font>&nbsp;&nbsp;<b><font color=\"crimson\">".$row["grade"]."</font></b></div>";
                    echo "<div class=\"description\">".$row["content"]."</div>";
                    $i++;
                }
            }
            ?>
        </div>
    </div>
</div>