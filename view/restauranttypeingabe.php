<?php include 'view/module/htmlbegin.php'; ?>
</nav>
<aside></aside>
<article>
<h2>Restauranttypeingabe</h2>
<form action="index.php" method="post">
    <input type="hidden" name="action" value="insert">
    <input type="hidden" name="area" value="restauranttyp">
    <thead>
        <thead>
        <tbody>
        <tr>
            <td>Restauranttyp:</td>
            <td><input name="name" type="text"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submitname" value="absenden"></td>
        </tr>

        </tbody>
    </thead>
    </table>


</form>
</article>
<?php include 'view/module/htmlend.php'; ?>