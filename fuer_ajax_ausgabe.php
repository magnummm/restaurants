<?php
include 'config.php';
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});
include 'class/Restaurant.php';

$search = $_GET['search']?? '';
$restaurants = Restaurant::SucheAuslesen($search);
echo $restaurants[0]->getName();
echo $restaurants[0]->getId();


