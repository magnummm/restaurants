<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<aside></aside>
<article>
<br>anmeldungsanzeige</br>


<form action="index.php" method="post">
    <input type="hidden" name="action" value="anmeldungpruefen">

    <table>
        <thead>
        <tbody>
        <tr>
            <td>Username:</td>
            <td><input name="username" type="text" ></td>
        </tr>
        <tr>
            <td>Passwort:</td>
            <td><input name="password" type="password" ></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitname" value="senden"></td>
        </tr>

</form>
<?php echo $fehlermeldung; ?>
</article>

