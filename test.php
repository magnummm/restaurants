<?php
//zum üben von der Klasse Restaurant

//include 'class/Restaurant.php';
//$r = new Restaurant(22222);
//
//$r->setOrt('Heinsberg') ;
//echo $r->getOrt();
//$r->setName('Berliner Hof');
//$r->setEroeffnungsdatum('2001-12-31');
//$r->setStrassehausnummer('Langestr. 3');

//echo '<pre>';
//print_r($r);
//echo '</pre>';

//Aufruf einer static Methode durch Klassenname :: Methodenname
//$r = Restaurant::getDataFromDatabase();
//echo'<pre>';
//print_r($r);
//echo '</pre';


// Runden 1 Stelle nach dem Komma

$zahl = 2.12345;
$gerundeteZahl = round($zahl, 4);
echo $gerundeteZahl;