<div id="root_wrap">
    <div class="content_wrap">
        <div class="box">
            <h1>Drucken</h1>
            <form method="post" action="print/print.php">
            <table class="box_table">
                <td style="text-align: right;">Monat:
                <td>
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
                </select>
                </td><tr>
                    
                <td style="text-align: right;">Jahr:</td>
                <td><input type="text" name="year" placeholder="z.B. 2017"></td><tr>
                    
                <td style="text-align: right;">Ausbildungsnachweis Nummer:</td>
                <td><input type="number" name="proof_number"></td><tr>
                    
                <td style="text-align: right;">Ausbildungsjahr Nummer (1-3):</td>
                <td><input type="number" name="year_number"></td><tr>
                    
                <td style="text-align: right;">Abteilung:</td>
                <td><input type="text" name="department" placeholder="z.B. IT"></td><tr>
                    
                <td style="text-align: right;">Täglich:</td>
                <td><input type="radio" id="radio1" name="print" value="daily" checked>
                <label for="radio1"></label></td><tr>
                
                <td style="text-align: right;">Flane Konform:</td>
                <td><input type="radio" id="radio2" name="print" value="flane">
                <label for="radio2"></label></td><tr>
                    
                <td style="text-align: right;">Glossar:</td>
                <td><input type="radio" id="radio3" name="print" value="glossary">
                <label for="radio3"></label></td><tr>
            </table>
                
            <input type="submit" class="btn" value="Druckansicht"><br>
                
            </form>
        </div>
    </div>
</div>