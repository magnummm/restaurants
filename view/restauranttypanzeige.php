
<?php include 'view/module/htmlbegin.php'; ?>

</nav>
<aside>
    <?php include 'view/module/aside.php'; ?>
</aside>


<article>


        <table>
            <thead>
            <tr>
                <th>Restauranttyp</th>
                <th>ÄkschN</th>
                <th>ÄkschN</th>
            </tr>

            </thead>

            <tbody>
            <?php
            for ($i = 0; $i < count($restauranttypen); $i++) {
                ?>
                <tr>
                    <td><?php echo $restauranttypen[$i]->getName(); ?></td>
                    <td>
                        <a href="index.php?action=loeschen&area=restauranttyp&id=<?php echo $restauranttypen[$i]->getId(); ?>"><button>Löschen</button></a>
                    </td>
                    <td>
                        <a href="index.php?action=zeigeaendern&area=restauranttyp&id=<?php echo $restauranttypen[$i]->getId(); ?>"><button>Ändern</button></a>
                    </td>
                </tr>

                <?php
            }
            ?>
            <tr>
                <td><a href="index.php?action=eingabe&area=restauranttyp"><button>Eingabe</button></a></td>
            </tr>

            </tbody>
        </table>


    </article>

<?php include 'view/module/htmlend.php'; ?>