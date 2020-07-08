<?php include 'view/module/htmlbegin.php'; ?>
    </nav>
    <aside></aside>
    <article>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="updaten">
    <input type="hidden" name="area" value="restauranttyp">
    <input type="hidden" name="id" value="<?php echo $restauranttyp->getId() ?>">
    <table>
        <thead>
        <tbody>
        <tr>
            <td>Restauranttyp:</td>
            <td><input name="name" type="text" value="<?php echo $restauranttyp->getName(); ?>"></td>
        </tr>
        <tr>

        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitname" value="aendern"></td>
        </tr>
        </tbody>
    </table>
</form>
    </article>
<?php include 'view/module/htmlend.php'; ?>