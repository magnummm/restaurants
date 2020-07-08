<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<header></header>
<aside></aside>
<article>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="insert">
    <input type="hidden" name="area" value="restaurant">

        <table>
            <thead>
        <tbody>
        <tr>
            <td>Restaurantname:</td>
            <td><input name="name" type="text"></td>
        </tr>
        <tr>
            <td><label for="plz">Postleitzahl:</label></td>
            <td><input name="plz" type="text" id="plz"></td>
        </tr>
        <tr>
            <td>Ort:</td>
            <td><input name="ort" type="text" value="Berlin"></td>

        </tr>
        <tr>
            <td>Strasse, Hausnummer:</td>
            <td><input name="strassehausnummer" type="text"></td>
        </tr>

        <tr>
            <td>Restauranttyp:</td>
            <td><?php echo Html::getPullDown(Restauranttyp::getDataFromDatabase(), 'restauranttypen'); ?></td>
        </tr>

        <tr>
            <td>Eröffnungsdatum:</td>
            <td><input name="eroeffnungsdatum" type="date"></td>
        </tr>
<!--<tr>-->
<!--    <td>Preiskategorie: </td>-->
<!--    <td>-->
<!--        <input type = "radio" id = "1" name="preiskategorie" value=1>-->
<!--        <label for = "1">1</label>-->
<!--        <input type = "radio" id = "2" name="preiskategorie" value=2>-->
<!--        <label for = "2">2</label>-->
<!--        <input type = "radio" id = "3" name="preiskategorie" value=3>-->
<!--        <label for = "3">3</label>-->
<!--        <input type = "radio" id = "4" name="preiskategorie" value=4>-->
<!--        <label for = "4">4</label>-->
<!--        <input type = "radio" id = "5" name="preiskategorie" value=5>-->
<!--        <label for = "5">5</label>-->
<!--    </td>-->
<!--</tr>-->
      <!--  <tr>
            <td>Bewertung: </td>
            <td>
                <input type = "radio" id = "1" name="benotung" value=1>
                <label for = "1">1</label>
                <input type = "radio" id = "2" name="benotung" value=2>
                <label for = "2">2</label>
                <input type = "radio" id = "3" name="benotung" value=3>
                <label for = "3">3</label>
                <input type = "radio" id = "4" name="benotung" value=4>
                <label for = "4">4</label>
                <input type = "radio" id = "5" name="benotung" value=5>
                <label for = "5">5</label>
                <input type = "radio" id = "6" name="benotung" value=6>
                <label for = "6">6</label>
            </td>
        </tr>-->
        <tr>

            <td><input type="submit" name="submitname" value="Absenden"></td>
        </tr>

        </tbody>
    </table>
</form>

<?php
$restauranttypen = Restauranttyp::getDataFromDatabase();
//echo'<pre>';
//print_r($_POST);
//echo '</pre';


?>
<!--<a href="index.php?action=anzeige">Anzeige</a>-->
</article>
<?php include 'view/module/htmlend.php'; ?>