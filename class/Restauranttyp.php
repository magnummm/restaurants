<?php


class Restauranttyp implements Saveable, JsonSerializable
{
    /*
     * zum Testen von boolean Getter und Setter
     */
    private bool $active;

    /*
     * PK auto_increment
     */
    private int $id;

    /*
     * VARCHAR(45)
     */
    private string $name;


    /**
     * Restaurant constructor.
     * @param int $id
     * @param string $name

     */
    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;

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

    /**
     * @return bool
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public static function getDataFromDatabase(): array
    {

        // Aufruf der Datenbank und Auslesen der Tabelle Restaurranttyp
        //aus allen Daten ein Objekt Restauranttyp erstellen

        try {

            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'SELECT *
        FROM restauranttyp';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->execute();
            $restauranttypen = $sth->fetchAll(PDO::FETCH_FUNC, 'Restauranttyp::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $restauranttypen;


    }


    //INSERT
    private static function insert(string $name): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            $dbh = Db::getConnection();
            // insert
            $sql = 'INSERT INTO restauranttyp(id, name)
                    VALUES(NULL, :name)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('name', $name, PDO::PARAM_STR);

            $sth->execute();
            $restauranttypen = $sth->fetchAll(PDO::FETCH_FUNC, 'Restauranttyp::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }

    //DELETE

    public static function deleteRestauranttyp (int $id): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            $dbh = Db::getConnection();
            // insert
            $sql = 'DELETE FROM restauranttyp WHERE (id=:id)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->execute();
            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restauranttyp::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }

//UPDATE
    public static function updateRestauranttyp(int $id, string $name): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */


        try {
            $dbh = Db::getConnection();
            // insert
            $sql = 'UPDATE restauranttyp SET name=:name
                    WHERE id=:id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->bindParam('name', $name, PDO::PARAM_STR);

            $sth->execute();
            // $restauranttypen = $sth->fetchAll(PDO::FETCH_FUNC, 'Restauranttyp::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }


    public static function buildRestauranttyp(string $name): void
    {
        Restauranttyp::insert($name);
    }

    public static function buildFromPDO(int $id, string $name): Restauranttyp
    {
        return new Restauranttyp($id, $name);
    }

    public static function getById(int $id): Restauranttyp
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */


        try {
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'SELECT *
        FROM restauranttyp
        WHERE id=:id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->execute();
            $restauranttypen = $sth->fetchAll(PDO::FETCH_FUNC, 'Restauranttyp::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $restauranttypen[0];

    }
    public function jsonSerialize()
    {
        return

            [
                'id' => $this->getId(),
                'name' => $this->getName()
            ];
    }


}