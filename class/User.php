<?php


class User implements Saveable
{
    private int $id;

    private string $user;

    private string $password;

    private string $rolle;






    /**
     * User constructor.
     * @param int $id
     * @param string $user
     * @param string $password
     * @param string $rolle
     */


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     */
    public function setUser(string $user): void
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getRolle(): string
    {
        return $this->rolle;
    }






    public function __construct(int $id, string $user, string $password, string $rolle)
    {
        $this->id = $id;
        $this->user = $user;
        $this->password = $password;
        $this->rolle = $rolle;
    }

    public static function getDataFromDatabase(): array
    {

        /* Connect to a MySQL database using driver invocation */
//        $dsn = 'mysql:dbname=user;host=localhost';
//        $user = 'teilnehmer';
//        $password = 'teilnehmer';

        try {

            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'SELECT *
        FROM user';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->execute();
            $users = $sth->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $users;
    }

    private static function insert(string $username, string $password): int
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'INSERT INTO user(id, username, password, rolle)
                    VALUES(NULL, :username, SHA(:password), "reguser")';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('password', $password, PDO::PARAM_STR);
//            $sth->bindParam('rolle', 'reguser', PDO::PARAM_STR);

            $sth->execute();
            // neu vergebener PK von db auslesen
            $id = $dbh->lastInsertId();
            $users = $sth->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');

            return $id;
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function delete(int $id): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            $dbh = Db::getConnection();
            $sql = 'DELETE FROM user WHERE (id = :id)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->execute();
            $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function update(int $id, string $username, string $password): void
    {

        //echo $id;

        try {
            $dbh = Db::getConnection();

            $sql = 'UPDATE user SET username=:username, password=SHA(:password) WHERE id=:id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('password', $password, PDO::PARAM_STR);
            $sth->execute();
            $users = $sth->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');
            $rFromDb = self::getById($id);

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function buildUser(string $user, string $password): int
    {
        $id = User::insert($user, $password);
        return $id;
    }

    public static function buildFromPDO(int $id, string $user, string $password, $rolle): User
    {
        $r = new User($id, $user, $password, $rolle);

        return $r;

    }

    public static function getById(int $id): User
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */
//pre::pretest($id);
        try {
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'SELECT * FROM user WHERE id=:id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('id', $id, PDO::PARAM_INT);
            $sth->execute();
            $users = $sth->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

        return $users[0];

    }

    public static function login(string $username, string $password): bool
    {


        try {
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'SELECT * FROM user WHERE username=:username AND password= SHA(:password)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('password', $password, PDO::PARAM_STR);
            $sth->execute();
            $users = $sth->fetchAll(PDO::FETCH_FUNC, 'User::buildFromPDO');

//            echo'<pre>';
//            print_r($users);
//            echo '</pre>';

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        if (count($users) == 1) {
            return true;
        } else {
            return false;
        }

    }

    public static function doesNameExist(string $username): bool
    {
        try {
            $dbh = Db::getConnection();
            //datenbank abfragen
            $sql = 'SELECT * FROM user WHERE username =:username';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->execute();
            $name = $sth->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        if (count($name) == 1) {
            return true;
        } else {
            return false;
        }

    }

    public static function getIdByNamePassword(string $username, string $password): int
    {
        try {
            $dbh = Db::getConnection();
            //datenbank abfragen
            $sql = 'SELECT id FROM user WHERE username =:username AND password =SHA(:password)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('username', $username, PDO::PARAM_STR);
            $sth->bindParam('password', $password, PDO::PARAM_STR);
            $sth->execute();
            $ids = $sth->fetchAll(PDO::FETCH_COLUMN);
            print_r($ids);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        if (count($ids) == 1) {
            print_r($ids);

            return $ids[0];
        } else {
            return 0;
        }
    }

    public static function getRestaurantbewertung(int $restaurant_id, int $user_id): int
    {
        return Bewertung_Restaurant_User::getUserbenotungPerRestaurant($restaurant_id, $user_id);
    }

    public static function setRestaurantBewertung(int $restaurant_id, int $user_id, int $benotung, $kommentar){
        Bewertung_Restaurant_User::setUserbenotungPerRestaurant($restaurant_id, $user_id, $benotung, $kommentar);
    }




}