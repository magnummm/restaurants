<?php


class Restaurant implements Saveable//, JsonSerializable
{


    /*
     * PK auto_increment
     */
    private int $id;

    /*
     * VARCHAR(45)
     */
    private string $name;

    /*
     * VARCHAR(5)
     */
    private string $plz;

    /*
     * VARCHAR(45)
     */
    private string $ort;

    /*
     * VARCHAR(45)
     */
    private string $strassehausnummer;

    /*
     * DATE (YYYY-MM-DD)
     */
    private string $eroeffnungsdatum;

    /*
     * INT
     */
    private int $preiskategorie;


    /**
     * Restaurant constructor.
     * @param int $id
     * @param string $name
     * @param string $plz
     * @param string $ort
     * @param string $strassehausnummer
     * @param string $eroeffnungsdatum
     * @param int $preiskategorie
     */

    private array $restauranttypen = [];

    public function __construct(int $id, string $name, string $plz, string $ort, string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie)
    {
        $this->id = $id;
        $this->name = $name;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->strassehausnummer = $strassehausnummer;
        $this->eroeffnungsdatum = $eroeffnungsdatum;
        $this->preiskategorie = $preiskategorie;

        // Array $restauranttypen füllen
        // zum Restaurant zu gehörige restauranttyp_ids ermitteln
        //$restauranttyp_ids = [];
        $restauranttypen_ids = Restaurant_Restauranttyp::getRestauranttyp_idsByRestaurant_id($id);

        for ($i = 0; $i < count($restauranttypen_ids); $i++) {
            $restauranttyp = Restauranttyp::getById($restauranttypen_ids[$i]);
            array_push($this->restauranttypen, $restauranttyp);
        }


    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }


    /**
     * @return string
     */
    public function getOrt(): string
    {
        return $this->ort;
    }

    /**
     * @param string $ort
     */
    public function setOrt(string $ort): void
    {
        $this->ort = $ort;
    }

    /**
     * @return string
     */
    public function getPlz(): string
    {
        return $this->plz;
    }

    /**
     * @param string $plz
     */
    public function setPlz(string $plz): void
    {
        $this->plz = $plz;
    }

    /**
     * @return string
     */
    public function getStrassehausnummer(): string
    {
        return $this->strassehausnummer;
    }

    /**
     * @param string $strassehausnummer
     */
    public function setStrassehausnummer(string $strassehausnummer): void
    {
        $this->strassehausnummer = $strassehausnummer;
    }

    /**
     * @return string
     */
    public function getEroeffnungsdatum(): string
    {
        return Format::deutschesZeitformat($this->eroeffnungsdatum);
    }

    /**
     * @param string $eroeffnungsdatum
     */
    public function setEroeffnungsdatum(string $eroeffnungsdatum): void
    {
        $this->eroeffnungsdatum = $eroeffnungsdatum;
    }


    public function getPreiskategorie(): int
    {
        return $this->preiskategorie;
    }

    /**
     * @param int $preiskategorie
     */
    public function setPreiskategorie(int $preiskategorie): void
    {
        $this->preiskategorie = $preiskategorie;
    }

    /**
     * @return int
     */


    /**
     * @return array
     */
    public function getRestauranttypen(): array
    {
        return $this->restauranttypen;
    }


    public static function getDataFromDatabase(string $condition = NULL, int $id = NULL): array
    {

        try {

            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = "SELECT id, name, plz, ort, strassehausnummer, eroeffnungsdatum, 
                        COALESCE(preiskategorie ,0) AS preiskategorie
                    FROM restaurant";
            if (isset($condition)) {
                $sql .= $condition;
            }
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            if (isset($condition)) {
                $sth->bindParam('id', $id, PDO::PARAM_INT);
            }
            $sth->execute();
            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restaurant::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $restaurants;
    }


    public function getDurchschnittsnote(): float
    {
        return bewertung_restaurant_user::getDurchschnittsnote($this->id);
    }


//Objekte aus gegebenen PK aus db auslesen
    public static function getById(int $id): Restaurant
    {
        $restaurants = Restaurant::getDataFromDatabase(' WHERE id=:id', $id);
        return $restaurants[0];
    }


//INSERT
    private static function insert(string $name, string $plz, string $ort, string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie, array $restauranttypen): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            //NULL bei preiskategorie, falls kein Wert eingetragen wurde
//            if ($preiskategorie === 0) {
//                $preiskategorie = NULL;
//            }
            echo $name;
            echo $plz;
            echo $ort;
            echo $strassehausnummer;
            echo $eroeffnungsdatum;
            echo $preiskategorie;
            pre::pretest($restauranttypen);

            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
                    VALUES(NULL, :name, :plz, :ort, :strassehausnummer, :eroeffnungsdatum, :preiskategorie)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('name', $name, PDO::PARAM_STR);
            $sth->bindParam('plz', $plz, PDO::PARAM_STR);
            $sth->bindParam('ort', $ort, PDO::PARAM_STR);
            $sth->bindParam('strassehausnummer', $strassehausnummer, PDO::PARAM_STR);
            $sth->bindParam('eroeffnungsdatum', $eroeffnungsdatum, PDO::PARAM_STR);
            $sth->bindParam('preiskategorie', $preiskategorie, PDO::PARAM_INT);

            $sth->execute();
            // neu vergebener PK von db auslesen
            $id = $dbh->lastInsertId();
            for ($i = 0; $i < count($restauranttypen); $i++) {
                $restauranttyp = Restaurant_Restauranttyp::insert($id, $restauranttypen[$i]);
            }

            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restaurant::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

//DELETE

    public static function delete(int $id): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            $dbh = Db::getConnection();
            echo $id . 'löschen';
            //Restaurant löschen heisst auch userbewertung und Zuordnung zum restauranttyp löschen
            //mit MySql
            $sql = 'DELETE FROM restaurant WHERE (id = :id)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->execute();
            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restaurant::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }

//UPDATE

    public
    static function update(int $id, string $name, string $plz, string $ort, string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie, array $restauranttypen): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */


        try {
            $dbh = Db::getConnection();
            // insert
            // null bei preiskategorie  berücksichtigen
//            if ($preiskategorie === 0) {
//                $preiskategorie = NULL;
//            }
            $sql = 'UPDATE restaurant SET name=:name, plz=:plz, ort=:ort, strassehausnummer=:strassehausnummer, 
                        eroeffnungsdatum=:eroeffnungsdatum, preiskategorie=:preiskategorie
                    WHERE id=:id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->bindParam('name', $name, PDO::PARAM_STR);
            $sth->bindParam('plz', $plz, PDO::PARAM_STR);
            $sth->bindParam('ort', $ort, PDO::PARAM_STR);
            $sth->bindParam('strassehausnummer', $strassehausnummer, PDO::PARAM_STR);
            $sth->bindParam('eroeffnungsdatum', $eroeffnungsdatum, PDO::PARAM_STR);
            $sth->bindParam('preiskategorie', $preiskategorie, PDO::PARAM_INT);
            $sth->execute();
            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restaurant::buildFromPDO');

            // update vom Attribut Array $restauranttypen

            $rFromDb = self::getById($id);
            $restaurantTypIdsFromDb = [];

            echo $id;

            for ($i = 0; $i < count($rFromDb->getRestauranttypen()); $i++) {
                array_push($restaurantTypIdsFromDb, $rFromDb->getRestauranttypen()[$i]->getId());
            }

            $restaurantTypIdsFromUser = $restauranttypen;

//            echo '<pre>';
//            echo '$resttypIdsFromDb';
//            print_r($restaurantTypIdsFromDb);
//            echo '$resttypIdsFromUser';
//            print_r($restaurantTypIdsFromUser);
//            echo '</pre>';

            for ($i = 0; $i < count($restaurantTypIdsFromUser); $i++) {
                // ist ... von FromUser etwas in ...FromDB?
                if (in_array($restaurantTypIdsFromUser[$i], $restaurantTypIdsFromDb)) {
                    //tue nichts
                    echo "tue nichts" . $i;
                } else {
                    echo $id, ' ' . $restaurantTypIdsFromUser[$i] . '<br>';
                    Restaurant_Restauranttyp::insert($id, $restaurantTypIdsFromUser[$i]);
                }
            }
            echo count($restaurantTypIdsFromDb);
            for ($i = 0; $i < count($restaurantTypIdsFromDb); $i++) {
                echo $i;
                // ist ... von FromDB etwas in ...FromUser?
                if (!in_array($restaurantTypIdsFromDb[$i], $restaurantTypIdsFromUser)) {
                    echo "restaurant; $id typ: $restaurantTypIdsFromDb[$i] <br>";
                    Restaurant_Restauranttyp::delete($id, $restaurantTypIdsFromDb[$i]);
                }
            }


        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }


    public static function buildRestaurant(string $name, string $plz, string $ort, string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie, array $restauranttypen): void
    {
        Restaurant::insert($name, $plz, $ort, $strassehausnummer, $eroeffnungsdatum, $preiskategorie, $restauranttypen);
    }

    public static function updateRestaurant(int $id, string $name, string $plz, string $ort,
                                            string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie, array $restauranttypen): void
    {
        Restaurant::update($id, $name, $plz, $ort, $strassehausnummer, $eroeffnungsdatum, $preiskategorie, $restauranttypen);
    }

    public static function deleteRestaurant(int $id): void
    {
        Restaurant::delete($id);
    }

//    public static function buildFromPDO(int $id, string $name, string $plz, string $ort, string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie, int $benotung): Restaurant
//    {
//
//    }

    public static function buildFromPDO(int $id, string $name, string $plz, string $ort, string $strassehausnummer, string $eroeffnungsdatum, int $preiskategorie): Restaurant
    {
        $r = new Restaurant($id, $name, $plz, $ort, $strassehausnummer, $eroeffnungsdatum, $preiskategorie);


        return $r;

    }


    /*
     * das Array von Restauranttypen wird als string übergeben,
     * als Trenner dient ein Komma
     */
    public function getRestauranttypenanzeige(): string
    {
        $html = '';
        $typs = [];
        for ($i = 0; $i < count($this->restauranttypen); $i++) {
            $typs[] = $this->restauranttypen[$i]->getName();
        }
        return implode(', ', $typs);
    }

    public static function SucheAuslesen(string $eingabe): array
    {
        //gib die restaurants mit den eingabebuchstaben einfach aus
        $eingabe = '%' . $eingabe . '%';
        try {

            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = "select * from restaurant where name LIKE :eingabe ;";

            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)

            $sth->bindParam('eingabe', $eingabe, PDO::PARAM_STR);

            $sth->execute();
            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restaurant::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $restaurants;

    }

//    public function jsonSerialize()
//    {
//        $restauranttypenJsonFormat = [];
//        for ($i = 0; $i < count($this->getRestauranttypen()); $i++) {
//            array_push($restauranttypenJsonFormat, $this->getRestauranttypen()[$i]->jsonSerialize());
//        }
//
//        return
//
//            [
//                'id' => $this->getId(),
//                'name' => $this->getName(),
//                'plz' => $this->getPlz(),
//                'ort' => $this->getOrt(),
//                'strassehausnummer' => $this->getStrassehausnummer(),
//                'eroeffnungsdatum' => $this->getEroeffnungsdatum(),
//                'preiskategorie' => $this->getPreiskategorie(),
//                'restauranttypen' => $restauranttypenJsonFormat
//
//
//            ];
//    }


}