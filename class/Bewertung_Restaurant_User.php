<?php


class Bewertung_Restaurant_User

{



    public static function getDurchschnittsnote(int $restaurant_id): float
    {
        try {
            $dbh = Db::getConnection();
            //datenbank abfragen
            $sql = 'SELECT AVG(note) FROM bewertung WHERE restaurant_id =:restaurant_id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->execute();
            $note = $sth->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        $note = round($note[0], 1);
        return $note;
        //pre::pretest($note);
    }

    public static function getUserbenotungPerRestaurant($restaurant_id, $user_id): int
    {
        try {
            $dbh = Db::getConnection();
            //datenbank abfragen
            $sql = 'SELECT note FROM bewertung WHERE restaurant_id =:restaurant_id AND user_id =:user_id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->bindParam('user_id', $user_id, PDO::PARAM_INT);
            $sth->execute();
            $note = $sth->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        if (isset($note[0])) {
            return (int)$note[0];
        } else {
            return 0;
        }
        //pre::pretest($note);


    }
    public static function getKommentarPerRestaurant($restaurant_id, $user_id): string
    {
        try {
            $dbh = Db::getConnection();
            //datenbank abfragen
            $sql = 'SELECT kommentar FROM bewertung WHERE restaurant_id =:restaurant_id AND user_id =:user_id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->bindParam('user_id', $user_id, PDO::PARAM_INT);
            $sth->execute();
            $kommentar = $sth->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        if (isset($kommentar[0])) {
            return (string)$kommentar[0];
        } else {
            return '-';
        }
    }
    public static function setUserbenotungPerRestaurant($restaurant_id, $user_id, $note, $kommentar){
        self::insertBenotung($restaurant_id, $user_id, $note, $kommentar);

    }

    public static function insertBenotung($restaurant_id, $user_id, $note, $kommentar) : void{
        try {pre::pretest($note);
            $dbh = Db::getConnection();
            // datenbank abfragen
            $sql = 'INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
                    VALUES(NULL, :note, :restaurant_id, :user_id, :kommentar)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->bindParam('user_id', $user_id, PDO::PARAM_INT);
            $sth->bindParam('note', $note, PDO::PARAM_INT);
            $sth->bindParam('kommentar', $kommentar, PDO::PARAM_STR);
            $sth->execute();
            // neu vergebener PK von db auslesen



        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }




}