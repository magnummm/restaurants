<?php include 'view/module/htmlbegin.php'; ?>

<h2 style="color:#381c36;text-align:center">Restaurants</h2>

<br>
<table style="width:100%;background-color: #eadcaf">
    <thead style="text-align:center; background-color: #d1a04a">
    <tr>
        <th>Restaurant</th>
        <th>Postleitzahl</th>
        <th>Ort</th>
        <th>Strasse, Hausnummer</th>
        <th>Restauranttyp</th>
        <th>Eröffnung</th>
<!--        <th>Preiskategorie</th>-->
        <th>Benotung</th>
        <th>ÄkschN</th>
        <th>ÄkschN</th>
    </tr>

    </thead>
    <tbody>
    <?php
    for ($i = 0; $i < count($restaurants); $i++) {
        ?>
        <tr>
            <td><?php echo $restaurants[$i]->getName(); ?></td>
            <td><?php echo $restaurants[$i]->getPlz(); ?></td>
            <td><?php echo $restaurants[$i]->getOrt(); ?></td>
            <td><?php echo $restaurants[$i]->getStrassehausnummer(); ?></td>
            <td><?php echo $restaurants[$i]->getRestauranttypenanzeige(); ?></td>
            <td><?php echo $restaurants[$i]->getEroeffnungsdatum(); ?></td>
<!--            <td>--><?php //echo $restaurants[$i]->getpreiskategorie(); ?><!--</td>-->
            <td><?php echo $restaurants[$i]->getBenotung(); ?></td>
            <td><a href="index.php?action=loeschen&area=restaurant&id=<?php echo $restaurants[$i]->getId(); ?>">Löschen</a></td>
            <td><a href="index.php?action=zeigeaendern&area=restaurant&id=<?php echo $restaurants[$i]->getId(); ?>">Ändern</a></td>
        </tr>
        <?php
    }
    ?>

    </tbody>
</table>
<br>
<a href="index.php?action=eingabe&area=restaurant">Eingabe</a>

<?php include 'view/module/htmlend.php'; ?>