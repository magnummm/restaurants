<?php
echo '<pre>';
print_r($_REQUEST);
echo '</pre';
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<a href="testButton.php?testvarbutton=buttontext"><button>Buttontext1</button></a>
<form method="post" action="testButton.php">
    <input type="text" value="42" name="textinput">
    <button type="button" name="vonButtonaufschrift" value="Buttonaufschrift"> Buttonaufschrift </button>
    <button type="submit" name="submitbutton" value="OK">Submitknopf</button>

<!--    bewertung abgeben submitknopf mit action und area-->
<!--    ausloggen, einloggen, registrieren mit get variablen-->


</form>
</body>
</html>
