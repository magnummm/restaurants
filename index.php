<?php
include 'config.php';

//fehlende Klassen werden hier on the fly eingebunden
spl_autoload_register(function ($class) {
    include 'class/' . $class . '.php';
});

pre::pretest($_POST);

//
//echo "<hr />";
//$ergebnis = pre::multiplizieren(3,4, 2);
//echo "<hr />";//horizontal ruler, horizontales Lineal
//$ergebnis2 = pre::multiplizieren2(1, 2, 3);
//echo "<hr />";
//pre::multiplizieren2 ($ergebnis2, $ergebnis2, $ergebnis2);
//echo "<hr />";
//echo $ergebnis2;
//echo "<hr />";
//pre::multiplizieren(pre::multiplizieren(2,1,1), pre::multiplizieren(1,1,1), pre::multiplizieren(1,1,1));
//echo "<hr />";
//pre::leistenkoennen(6000);
//echo "<hr />";
////v1
//pre::pretest($farbe = pre::farbefuerzahl(1));
//echo "<hr />";
////v2 ragnar
//$farberagnar = pre::farbefuerzahl(3);
//pre::pretest($farberagnar);
//echo "<hr />";

// links sind Übergabevariablen - rechts ist die Quelle der Formulare mit method post und index.php
$id = $_REQUEST['id'] ?? 0; // kurzes if (isset($_POST.... ;)
$area = $_REQUEST['area'] ?? 'restaurant';
$name = $_POST['name'] ?? '';
$user = $_POST['user'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$password2 = $_POST['password2'] ?? '';
$plz = $_POST['plz'] ?? '';
$ort = $_POST['ort'] ?? '';
$strassehausnummer = $_POST['strassehausnummer'] ?? '';
$eroeffnungsdatum = $_POST['eroeffnungsdatum'] ?? '';
$preiskategorie = $_POST['preiskategorie'] ?? 0;
$restauranttypen = $_POST['restauranttypen'] ?? '';
$benotung = $_POST['benotung'] ?? 0;
$fehlermeldung = $_POST['fehlermeldung'] ?? '';
$kommentar = $_POST['kommentar'] ?? '';


$action = $_REQUEST['action'] ?? 'anzeige';
$suchfeld = $_POST['suchfeld'] ?? '';
$view = '';
$search = $_GET['search']?? '';


pre::pretest($action);
pre::pretest($area);
//
//echo $suchfeld;
//echo $kommentar;



//insert umsetzen
switch($action)
{

    case'insert':
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        if ($area === 'restaurant') {
            Restaurant::buildRestaurant($name, $plz, $ort, $strassehausnummer, $eroeffnungsdatum, $preiskategorie, $restauranttypen);
        } elseif ($area === 'restauranttyp') {
            Restauranttyp::buildRestauranttyp($name);
        } elseif ($area === 'user') {
            User::buildUser($user, $password);
        }
//        $action = 'anzeige';
        include 'view\\' . $area . 'eingabe.php';
        break;
    }

//update umsetzen
    case 'updaten':
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        if ($area === 'restaurant') {
            Restaurant::updateRestaurant($id, $name, $plz, $ort, $strassehausnummer, $eroeffnungsdatum, $preiskategorie, $restauranttypen);
            User::setRestaurantBewertung($id, $user_id, $benotung, $kommentar);
            $restaurants = Restaurant::getDataFromDatabase();
            //$view = 'restaurantanzeige';

        } elseif ($area === 'restauranttyp') {
            Restauranttyp::updateRestauranttyp($id, $name);
            $restauranttypen = Restauranttyp::getDataFromDatabase();
            //$view = $area . 'anzeige';

        } elseif ($area === 'user') {
            User::update($id, $user, $password);
            $users = User::getDataFromDatabase();
            //$view = $area . 'anzeige';
        }

        Bewertung_Restaurant_User::insertBenotung($id, $user_id, $benotung, $kommentar);
        include 'view\\' . $area . 'anzeige.php';
        break;
    }

//    User::setRestaurantBewertung($id, $user_id, $benotung, $kommentar);
    // $action = 'anzeige';

//löschen umsetzen
    case 'loeschen':
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        if ($area === 'restaurant') {
            Restaurant::deleteRestaurant($id);
            $restaurants = Restaurant::getDataFromDatabase();
        } elseif ($area === 'restauranttyp') {
            Restauranttyp::deleteRestauranttyp($id);
            $restauranttypen = Restauranttyp::getDataFromDatabase();
        } elseif ($area === 'user') {
            User::delete($id);
            $users = User::getDataFromDatabase();
        }

        include 'view\\' . $area . 'anzeige.php';
        break;
    }
    //zeige restaurantaendern.php an
    case 'zeigeaendern':
    {
        if ($area === 'restaurant') {
            session_start();
            $user_id = $_SESSION['user_id'];
            $restaurant = Restaurant::getById($id);
        } elseif ($area === 'restauranttyp') {
            $restauranttyp = Restauranttyp::getById($id);
        } elseif ($area === 'user') {
            $user = User::getById($id);
        }

        include 'view\\' . $area . 'aendern.php';
        break;
    }

    case 'eingabe':
    {
        if ($area === 'restaurant') {
            include 'view\restauranteingabe.php';
        } elseif ($area === 'restauranttyp') {
            include 'view\restauranttypeingabe.php';
        } elseif ($area === 'user') {
            include 'view\usereingabe.php';
        }

        break;
    }

    case 'registrieren':
    {
        $fehlermeldung = '';
        include 'view\registrieren.php';
        break;
    }


    case 'registrierenueberpruefen':
    {
        $fehlermeldung = '';
        if ($password !== $password2) {
            $fehlermeldung = 'Die Passwörter stimmen nicht überein';
            include 'view\registrieren.php';
        } elseif (strlen($password) < 1) {
            $fehlermeldung = 'Das Passwort ist zu kurz';
            include 'view\registrieren.php';
        } else {
            //überprüfung ob es usernamen schon gibt
            if (User::doesNameExist($name)) {
                $fehlermeldung = 'user existiert bereits';
                include 'view\registrieren.php';
            } else {

                $id = User::buildUser($name, $password);
                session_start();
                $_SESSION['user_id'] = $id;
                $user_id = $id;
                $restaurants = Restaurant::getDataFromDatabase();
                include 'view\restaurantanzeige.php';
            }
        }
        break;
    }

    case 'einloggenanzeigen':
    {
        $fehlermeldung = '';
        include 'view\anmeldung.php';
        break;
    }
    case 'anmeldungpruefen':
    {
        $id = USER::getIdByNamePassword($username, $password);
        if ($id > 0) { pre::pretest('anmeldungpruefen');
            session_start();
            $_SESSION['user_id'] = $id;
            $user_id = $id;
            $restaurants = Restaurant::getDataFromDatabase();
            include 'view\restaurantanzeige.php';
        } else {
            $fehlermeldung = 'Der Username oder das Passwort ist falsch.';
            include 'view\restaurantanzeige.php';
        }

        break;
    }

    case 'ausloggen':
    {
        //session wird ohne "session_start()" automatisch beendet
        $restaurants = Restaurant::getDataFromDatabase();
        include 'view\restaurantanzeige.php';
        break;
    }

    case 'suchen':
    {
        echo "hierwirdgesucht";
        $restaurants = Restaurant::SucheAuslesen($suchfeld);
        include 'view\restaurantanzeige.php';
        break;
    }


//    case 'anzeigedefault':
//    {
//        session_start();
//        $user_id = $_SESSION['user_id'];
//        $restaurants = Restaurant::getDataFromDatabase();
//        $view = 'restaurantanzeige';
//        break;
//    }

    case 'registrierenanzeige':
    {
        include 'view\registrierenanzeige.php';
        $view = $area;
        break;
    }
    case 'anzeige':
    {
        if ($area === 'restaurant') {

            $restaurants = Restaurant::getDataFromDatabase();
            include 'view\\' . $area . 'anzeige.php';
        } elseif ($area === 'restauranttyp') {
            session_start();
            $user_id = $_SESSION['user_id'] ?? null;
            $restauranttypen = Restauranttyp::getDataFromDatabase(); //ein Array mit allen Restaurantsobjekten
            include 'view\\' . $area . 'anzeige.php';
        } elseif ($area === 'user') {
            session_start();
            $user_id = $_SESSION['user_id'] ?? null;
            $users = User::getDataFromDatabase(); //ein Array mit allen Restaurantsobjekten
            include 'view\\' . $area . 'anzeige.php';
        }
        $view = $area . 'anzeige';
        break;
    }
    case 'search':
        {
        $restaurants= Restaurant::SucheAuslesen($search);
        echo $restaurants[0]->getName();
        echo $restaurants[0]->getId();
        echo $restaurants[0]->getplz();
            $view = $area . 'anzeige';
        //für die ajax rückgabe wird die index.php nicht mehr benötigt

        die();
        break;

    }
    default:
    {
        if ($area === 'restaurant') {
            session_start();
            $user_id = $_SESSION['user_id'] ?? 0;
            $restaurants = Restaurant:: getDataFromDatabase(); // es kommt raus: ein Array mit allen Restaurantobjekten
            include 'view\restaurantanzeige.php';
        } elseif ($area === 'restauranttyp') {
            session_start();
            $user_id = $_SESSION['user_id'] ?? null;
            $restauranttypen = Restauranttyp:: getDataFromDatabase();
            $view = $area . 'anzeige';
        } elseif ($area === 'user') {
            session_start();
            $user_id = $_SESSION['user_id'] ?? null;
            $users = User:: getDataFromDatabase();
            $view = $area . 'anzeige';
        }
        $view = $area .'anzeige';
        //Testausgabe für Umlaute
//        echo '<script>';
//        echo 'var ausgabe = ' .json_encode($restaurants[0]).';';
//        echo 'alert(JSON.stringify(ausgabe));';
//        echo  '</script>';

    }




}
//echo json_encode($restaurants[0]->jsonSerialize());

//include 'view/'. $view . '.php';



