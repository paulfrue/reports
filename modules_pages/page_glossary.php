<?php
include('sql.php');
session_start();

$query = "SELECT * FROM glossary WHERE userID = ".$_SESSION["userID"]." AND deleted = 0 ORDER BY category ASC";
$result = $mysqli->query ($query);
?>

<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
        <form method="post" action="modules_create/create_glossary.php">
            <h1>Neuer Glossar Eintrag</h1>
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
            <select name="category">
                <option value="1">Programmiersprachen</option>
                <option value="2">Interne Kürzel</option>
                <option value="3">Kurse</option>
                <option value="4">Labs</option>
                <option value="5">Räume</option>
                <option value="6">Unterrichtsfächer</option>
                <option value="7">Hardware</option>
                <option value="8">Software</option>
                <option value="9">Techniken</option>
                <option value="10">Protokolle</option>
                <option value="11">Firmen</option>
            </select>
            <br><br>
            Begriff: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="term" style="width: 400px;"><br><br>
            Erklärung: <textarea name="description"></textarea><br><br>
            <input type="submit" class="btn" value="Eintrag speichern">
        </form>
        </div>
        <div class="box">
            <h1>Glossar</h1>
            <hr>
            <?php
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                if($i<$result->num_rows) {
                    echo "<div class=\"term\">".$row["term"]."</div>";
                    echo "<div class=\"description\">".$row["description"]."</div>";
                    $i++;
                }
            }
            ?>
        </div>
    </div>
</div>