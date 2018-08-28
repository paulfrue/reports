<div class="box">
    <h1>Berichte Filtern</h1>
    
    <?php
    include("layout_filter_userview.php");
    ?>
    
    <table class="box_table">
        <td colspan="3">
            <input type="button" class="btn" value="All" onclick="location.href='index.php?filter=all'">
            <input type="button" class="btn" value="Last 5" onclick="location.href='index.php?filter=lastfive'">
            <input type="button" class="btn" value="Last 30" onclick="location.href='index.php?filter=lastthirty'">
            <input type="button" class="btn" value="School" onclick="location.href='index.php?filter=school'">
            <input type="button" class="btn" value="Illness" onclick="location.href='index.php?filter=ill'">
            <input type="button" class="btn" value="Vacation" onclick="location.href='index.php?filter=vacation'">
            <input type="button" class="btn" value="Holiday" onclick="location.href='index.php?filter=holiday'">
            <input type="button" class="btn" value="Overtime" onclick="location.href='index.php?overtime'">
            <input type="button" class="btn" value="Late" onclick="location.href='index.php?filter=late'">
            <input type="button" class="btn" value="Night" onclick="location.href='index.php?filter=night'">
        </td><tr>
        <form method="post" action="index.php?searchtask">
            <td align="right">Tätigkeit:</td>
            <td><input type="text" name="task"></td>
            <td><input type="submit" class="btn" value="Nach Tätigkeit Suchen" style="width: 150px;"></td><tr>
        </form>
        <form method="post" action="index.php?searchdate">
            <td align="right">Datum:</td>
            <td><input type="text" name="date" placeholder="TT.MM.JJJJ"></td>
            <td><input type="submit" class="btn" value="Nach Datum Suchen" style="width: 150px;"></td><tr>
        </form>
        <?php 
            $cwdate = date('W', time())."";
            $cwdate = (int) $cwdate;
        ?>
        <form method="post" action="index.php?searchcw">
            <td align="right">Kalenderwoche:</td>
            <td><input type="number" name="cw" style="width: 50px;" value="<?php echo $cwdate;?>"></td>
            <td><input type="submit" class="btn" value="Nach Woche Suchen" style="width: 150px;"></td><tr>
        </form>
    </table>
</div>