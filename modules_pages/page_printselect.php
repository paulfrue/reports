<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
            <h1>Drucken</h1>
            <hr>
            <form method="post" action="print/print.php">
                <br>
                Monat:
                <select name="month" size="1">
                    <option value="1">Januar</option>
                    <option value="2">Februar</option>
                    <option value="3">März</option>
                    <option value="4">April</option>
                    <option value="5">Mai</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Dezember</option>
                </select><br><br>
                Jahr:
                <input type="text" name="year" placeholder="z.B. 2017"><br><br>
                Ausbildungsnachweis Nummer:
                <input type="number" name="proof_number"><br><br>
                Ausbildungsjahr Nummer (1-3):
                <input type="number" name="year_number"><br><br>
                Abteilung:
                <input type="text" name="department" placeholder="z.B. IT"><br><br>
                Täglich:
                <input type="radio" id="radio1" name="print" value="daily" checked>
                <label for="radio1"></label>
                Flane Konform:
                <input type="radio" id="radio2" name="print" value="flane">
                <label for="radio2"></label>
                Glossar:
                <input type="radio" id="radio3" name="print" value="glossary"><label for="radio3"></label>
                <br><br>
                <input type="submit" class="btn" value="Druckansicht"><br><br>
            </form>
        </div>
    </div>
</div>