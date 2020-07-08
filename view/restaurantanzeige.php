<?php include 'view/module/htmlbegin.php'; ?>
<input type="hidden" name="area" value="restaurant">

<?php $user_id = $_SESSION['user_id'] ?? null; ?>

<?php if (isset($user_id)) {
    echo '<a href="index.php?action=ausloggen&area=user"><button>Ausloggen</button></a>';

//    pre::pretest(User::getById($user_id));

} else {
    echo '<a href = "index.php?action=einloggenanzeigen&area=user"><button>Einloggen</button></a>

    <a href = "index.php?action=registrierenanzeige&area=user"><button>Registrieren</button></a>';

}

if (isset($user_id) && User::getById($user_id)->getRolle() === 'admin') {
    echo '<a href="index.php?action=eingabe&area=restaurant"><button>Eingabe</button></a>';
}

?>
</nav>
<aside>
    <?php include 'view/module/aside.php'; ?>
</aside>
<article>

<table>
    <thead>
    <th>Restaurant</th>
    <th>Plz</th>
    <th>Ort</th>
    <th>Strasse, Hausnummer</th>
    <th>Restauranttyp</th>
    <th>Eröffnung</th>
    <!--        <th>Preiskategorie</th>-->
    <th>Bewertung</th>
    <th></th>
    <th></th>
    <th>Kommentare</th>
    </thead>
    <tbody>

    <tr>

        <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'reguser') {
            echo '<th>bisherige Bewertung</th>';
        } ?>
        <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'admin') {
            echo '';//<th></th><th></th>
        } ?>

    </tr>



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
            <td><?php echo $restaurants[$i]->getDurchschnittsnote(); ?></td>
            <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'reguser')
            //            {
            //                if (User::getRestaurantbewertung($restaurants[$i]->getId(), $_SESSION['user_id'])===0)
            //                {
            //                ?>
            <!--                <td><a href="index.php?action=zeigeaendern&area=restaurant&id=-->
            <?php //echo $restaurants[$i]->getId(); ?><!--"><button>Bewerten</button></a></td>-->
            <!--                --><?php
            //                }else{
            //                    echo '<td>' . User::getRestaurantbewertung($restaurants[$i]->getId(), $_SESSION['user_id']) . '</td>';
            //                }
            //            }
            //            ?>
            <!--            andere Lösung-->
            <?php if (isset($user_id) && User::getById($user_id)->getRolle() === 'reguser') {
                if (User::getRestaurantbewertung($restaurants[$i]->getId(), $user_id) == 0) {
                    $id = $restaurants[$i]->getId();
                    echo '<td><a href="index.php?action=zeigeaendern&area=restaurant&id=' ?><?php echo $id; ?><?php echo '"><button>bewerten</button></a></td>';

                } else {

                    echo '<td>' . User::getRestaurantbewertung($restaurants[$i]->getId(), $user_id) . '</td>';
                }
            }
            if (isset($user_id) && User::getById($user_id)->getRolle() === 'admin') {
                echo '<td><a href="index.php?action=loeschen&area=restaurant&id=' . $restaurants[$i]->getId() . '"><button>Löschen</button></a></td>
        <td><a href="index.php?action=zeigeaendern&area=restaurant&id=' . $restaurants[$i]->getId() . '"><button>Ändern</button></a></td>';
            }
            ?>
            <td>
                <?php
                if (Bewertung_Restaurant_User::getKommentarPerRestaurant($restaurants[$i]->getId(), $user_id) === '-' && ($user_id != 0)) {
                    echo '<a href="index.php?action=zeigeaendern&area=restaurant&id=' ?><?php echo $id; ?><?php echo '" ><button>kommentieren</button></a>';
                } else {
                    echo Bewertung_Restaurant_User::getKommentarPerRestaurant($restaurants[$i]->getId(), $user_id);
                }
                ?></td>


        </tr>
        <?php
    }
    ?>
</tbody>
</table>
</article>
<footer>
    <h2>die besten Restaurants</h2>
</footer>
<?php include 'view/module/htmlend.php'; ?>






