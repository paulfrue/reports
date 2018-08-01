<div class="box">
    <h1>Berichte Filtern</h1>
    <hr>
    
    <?php
    include("layout_filter_userview.php");
    ?>
    
    <input type="button" class="btn" value="Alle" onclick="location.href='index.php?filter=all'">
    <input type="button" class="btn" value="Letzten 5" onclick="location.href='index.php?filter=lastfive'">
    <input type="button" class="btn" value="Letzten 30" onclick="location.href='index.php?filter=lastthirty'">
    <input type="button" class="btn" value="Schule" onclick="location.href='index.php?filter=school'">
    <input type="button" class="btn" value="Krankheit" onclick="location.href='index.php?filter=ill'">
    <input type="button" class="btn" value="Urlaub" onclick="location.href='index.php?filter=vacation'">
    <input type="button" class="btn" value="Feiertage" onclick="location.href='index.php?filter=holiday'">
    <input type="button" class="btn" value="Überstunden" onclick="location.href='index.php?overtime'">
    <br><br>
    <table width="100%">
        <form method="post" action="index.php?searchtask">
            <td align="right">Tätigkeit:</td>
            <td align="center"><input type="text" name="task"></td>
            <td align="left"><input type="submit" class="btn" value="Nach Tätigkeit Suchen" style="width: 150px;"></td><tr>
        </form>
        <form method="post" action="index.php?searchdate">
            <td align="right">Datum:</td>
            <td align="center"><input type="text" name="date" placeholder="TT.MM.JJJJ"></td>
            <td align="left"><input type="submit" class="btn" value="Nach Datum Suchen" style="width: 150px;"></td><tr>
        </form>
        <?php 
            $cwdate = date('W', time())."";
            $cwdate = (int) $cwdate;
        ?>
        <form method="post" action="index.php?searchcw">
            <td align="right">Kalenderwoche:</td>
            <td align="center"><input type="number" name="cw" style="width: 50px;" value="<?php echo $cwdate;?>"></td>
            <td align="left"><input type="submit" class="btn" value="Nach Woche Suchen" style="width: 150px;"></td><tr>
        </form>
    </table>
</div>