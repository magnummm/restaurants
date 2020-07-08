<?php include 'view/module/htmlbegin.php'; ?>

</nav>
<aside>
    <?php include 'view/module/aside.php'; ?>
</aside>
<article>
<table>
    <thead>

    <tr>
        <th>Username</th>
        <th>Password</th>
        <th>ÄkschN</th>
        <th>ÄkschN</th>
    </tr>
    </thead>

    <tbody>
    <?php
    for ($i = 0; $i < count($users); $i++) {
    ?>


    <tr>
        <td><?php echo $users[$i]->getUser(); ?></td>
        <td><?php echo $users[$i]->getPassword(); ?></td>
        <td><a href="index.php?action=loeschen&area=user&id=<?php echo $users[$i]->getId(); ?>"><button>Löschen</button></a></td>
        <td><a href="index.php?action=zeigeaendern&area=user&id=<?php echo $users[$i]->getId(); ?>"><button>Ändern</button></a></td>
    </tr>

        <?php
    }
        ?>
    <tr>
        <td><a href="index.php?action=eingabe&area=user"><button>Eingabe</button></a></td>

    </tr>
    </article>

    <?php include 'view/module/htmlend.php'; ?>



