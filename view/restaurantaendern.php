<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<aside></aside>
<article>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="updaten">
    <input type="hidden" name="area" value="restaurant">
    <input type="hidden" name="id" value="<?php echo $restaurant->getId() ?>">
    <table>
        <thead>
        <tbody>
        <tr>
            <td>Restaurantname:</td>
            <td><input name="name" type="text" value="<?php echo $restaurant->getName(); ?>"
                    <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser') {echo 'readonly';}?> ></td>
        </tr>
        <tr>
            <td>PLZ:</td>
            <td><input name="plz" type="text" value="<?php echo $restaurant->getPlz(); ?>"
                    <?php if(isset($user_id ) && User::getById($user_id)->getRolle() === 'reguser'){echo 'readonly';}?>></td>
        </tr>
        <tr>
            <td>Ort:</td>
            <td><input name="ort" type="text" value="<?php echo $restaurant->getOrt(); ?>"
                    <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser'){echo 'readonly';}?>></td>
        </tr>
        <tr>
            <td>Strasse, Hausnummer:</td>
            <td><input name="strassehausnummer" type="text" value="<?php echo $restaurant->getStrassehausnummer(); ?>"
                    <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser'){echo 'readonly';}?>>
            </td>
        </tr>
        <tr>
            <td>Restauranttyp:</td>
            <td><?php echo Html::getPullDownPreSelected(Restauranttyp::getDataFromDatabase(), 'restauranttypen', $restaurant); ?></td>
        </tr>
        <tr>
            <td>Eröffnungsdatum:</td>
            <td><input name="eroeffnungsdatum" type="date" value="<?php echo Format::sqlZeitformat($restaurant->getEroeffnungsdatum()); ?>" <?php if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser'){echo 'readonly';}?>>
            </td>
        </tr>
<!--        <tr>-->
<!--            <td>Preiskategorie:</td>-->
<!--            <td>-->
<!--                <input type = "radio" --><?php //if($restaurant->getPreiskategorie() === 1){ echo 'checked';} ?><!-- id = "1" name="preiskategorie" value="1">-->
<!--                <label for = "1">1</label>-->
<!--                <input type = "radio" --><?php //if($restaurant->getPreiskategorie() === 2){ echo 'checked';} ?><!-- id = "2" name="preiskategorie" value="2">-->
<!--                <label for = "2">2</label>-->
<!--                <input type = "radio" --><?php //if($restaurant->getPreiskategorie() === 3){ echo 'checked';} ?><!-- id = "3" name="preiskategorie" value="3">-->
<!--                <label for = "3">3</label>-->
<!--                <input type = "radio" --><?php //if($restaurant->getPreiskategorie() === 4){ echo 'checked';} ?><!-- id = "4" name="preiskategorie" value="4">-->
<!--                <label for = "4">4</label>-->
<!--                <input type = "radio" --><?php //if($restaurant->getPreiskategorie() === 5){ echo 'checked';} ?><!-- id = "5" name="preiskategorie" value="5">-->
<!--                <label for = "5">5</label>-->
<!--            </td>-->
<!--        </tr>-->
        <tr>
            <td>Kommentare:</td>
            <td><input name="kommentar" type="text"</td>

        </tr>

        <?php
        if(isset($user_id) && User::getById($user_id)->getRolle() === 'reguser')
        {
        ?>
        <tr>
            <td>Bewertung:</td>
            <td>
                <input type = "radio" <?php if(User::getRestaurantbewertung($restaurant->getId(), $user_id) === 1){ echo 'checked';} ?> id = "1" name="benotung" value="1">
                <label for = "1">1</label>
                <input type = "radio" <?php if(User::getRestaurantbewertung($restaurant->getId(), $user_id) === 2){ echo 'checked';} ?> id = "2" name="benotung" value="2">
                <label for = "2">2</label>
                <input type = "radio" <?php if(User::getRestaurantbewertung($restaurant->getId(), $user_id) === 3){ echo 'checked';} ?> id = "3" name="benotung" value="3">
                <label for = "3">3</label>
                <input type = "radio" <?php if(User::getRestaurantbewertung($restaurant->getId(), $user_id) === 4){ echo 'checked';} ?> id = "4" name="benotung" value="4">
                <label for = "4">4</label>
                <input type = "radio" <?php if(User::getRestaurantbewertung($restaurant->getId(), $user_id) === 5){ echo 'checked';} ?> id = "5" name="benotung" value="5">
                <label for = "5">5</label>
                <input type = "radio" <?php if(User::getRestaurantbewertung($restaurant->getId(), $user_id) === 6){ echo 'checked';} ?> id = "6" name="benotung" value="6">
                <label for = "6">6</label>
            </td>
        </tr>
        <?php
        }
       ?>



        <tr>
            <td></td>
            <td><input type="submit" name="submitname" value="Ändern"></td>
        </tr>
        <thead>
        <?php include 'view/module/htmlend.php'; ?>
</form>
</article>
