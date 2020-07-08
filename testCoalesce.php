<?php


//echo '<pre>';
//print_r($_POST);
//echo '</pre';

//ab 7.4
$var ??= '';
echo '<br>$var: ' . $var . '<br>';


//alter Weg
//$var = '';
//if (isset($_POST)) {
//    if (isset($_POST['var'])) {
//        $action = $_POST['var'];
//    }
//}

//ab 7.2 null voalesce Operator
$var = $_POST['var'] ?? ''; //var wird überschrieben
echo '<br>$var: ' . $var . '<br>'; // geeignete Lösung für variablenempfang



?>
<form method="post" action="testCoalesce.php">
    <input type="text" name="var" value="testvar">
    <input type="submit">

</form>
