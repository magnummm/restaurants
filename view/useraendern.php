<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<aside></aside>
<article>
<form action="index.php" method="post">
    <input type="hidden" name="id" value="<?php echo $user->getId();?>">
    <input type="hidden" name="action" value="updaten">
    <input type="hidden" name="area" value="user">
    <table>
        <thead>
        <tbody>
        <tr>
            <td>User:</td>
            <td><input name="user" type="text" value="<?php echo $user->getUser();?>"></td>
        </tr>
        <tr>
            <td><label for="password">Password:</label></td>
            <td><input name="password" type="password" id="password" value=""></td>
        </tr>


        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitname" value="OK"></td>
        </tr>

        </tbody>
    </table>
</form>


<a href="index.php?action=auslesen">Anzeige</a>
</article>
<?php include 'view/module/htmlend.php'; ?>
