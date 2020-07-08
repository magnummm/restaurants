<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<aside></aside>
<article>
    <h2>Usereingabe</h2>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="insert">
    <input type="hidden" name="area" value="user">
    <table>
        <thead>
        <tbody>
        <tr>
            <td><label for="user"</label></td>
            <td><input name="user" type="text"></td>
        </tr>
        <tr>
            <td><label for="password">Password:</label></td>
            <td><input name="password" type="password" id="password"></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" name="submitname" value="OK"></td>
        </tr>

        <?php include 'view/module/htmlend.php'; ?>


</form>
<?php
$users = User::getDataFromDatabase();
?>
</article>

<!--<a href="index.php?action=auslesen">Anzeige</a>-->

