<?php
$var = $_POST['var']?? '';
switch ($var){
    case '1';
        echo 'Fall1';
        break;
    case '2';
        echo 'Fall2';
        break;
    default:
        echo 'default';
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form method="post" action="testSwitchCase.php">
    <input type="text" name="var">
    <input type="submit">
</form>
</body>
</html>
