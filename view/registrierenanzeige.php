<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<aside></aside>
<article>
    <h1> Anmelden </h1>
    <form action= "index.php" method="post">
        <input type="hidden" name="action" value="registrierenueberpruefen">
        <table>
            <thead>
            <tbody>
            <tr>
                <td>Username:</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Passwort:</td>
                <td><input type="password" name="password"></td>
            </tr>
            <tr>
                <td>Passwort wiederholen:</td>
                <td><input type="password" name="password2"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="reset"> <input type="submit" name="" value="Registrieren"></td>
            </tr>

            <?php echo $fehlermeldung; ?>

            <?php include 'view/module/htmlend.php'; ?>
    </form>
</article>



