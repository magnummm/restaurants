<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <link type="text/css" href="css/style.css" rel="stylesheet" media="screen" />
    <title>Restaurantbeurteilung</title>
</head>


<body>
<div id="container">
    <header>
        <h2>Restaurants</h2>
    </header>
    <nav>
<?php

if (isset($user_id) && User::getById($user_id)->getRolle() === 'admin'){
   ?>
    <table>

        <tbody>
<tr>
    <td><a href="index.php?action=anzeige&area=restaurant"><button>Restaurants</button></a></td>


</tr>
        <tr>
            <td><a href="index.php?action=anzeige&area=restauranttyp"><button>Restauranttypen</button></a></td>
        </tr>
        <tr>
            <td><a href="index.php?action=anzeige&area=user"><button>Usernamen</button></a></td>
        </tr>
        </tbody>

    </table>
<?php
}
?>

<!--<td>--><?php //echo bewertung_restaurant_user::getDurchschnittsnote(1); ?><!-- </td>-->
<!--<table style="width:100%;background-color: #eadcaf">-->
<!--    <thead style="text-align:center; background-color: #d1a04a">-->