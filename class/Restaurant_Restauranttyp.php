<?php


class Restaurant_Restauranttyp
{
private int $id;
private int $restaurant_id;
private int $restauranttyp_id;

    public static function insert(int $restaurant_id, int $restauranttyp_id): void
    {
        //interaktion mit Datenbank
        /* Connect to a MySQL database using driver invocation */

        try {
            $dbh = Db::getConnection();
            // insert
            $sql = 'INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id)
                    VALUES(NULL, :restaurant_id, :restauranttyp_id)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->bindParam('restauranttyp_id', $restauranttyp_id, PDO::PARAM_INT);
            $sth->execute();
            //Ziel Rückgabe Restauranttyp-Objekt
            $restauranttyp = Restauranttyp::getById($restauranttyp_id);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }

    }
    public static function delete(int $restaurant_id, int $restauranttyp_id) : void {
        try {
            $dbh = Db::getConnection();
            // insert
            $sql = 'DELETE FROM restaurant_restauranttyp WHERE (restaurant_id=:restaurant_id AND restauranttyp_id=:restauranttyp_id)';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->bindParam('restauranttyp_id', $restauranttyp_id, PDO::PARAM_INT);
            $sth->execute();
           // $restaurants = $sth->fetchAll(PDO::FETCH_FUNC, 'Restaurant::buildFromPDO');
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }
    public static function getRestauranttyp_idsByRestaurant_id(int $restaurant_id) : array
    {
        try {
            $dbh = Db::getConnection();
            // datenbank abragen
            $sql = 'SELECT restauranttyp_id
            From restaurant_restauranttyp
            WHERE restaurant_id=:restaurant_id';
            $sth = $dbh->prepare($sql);// $sth für PDO Statement (prepared Statement)
            $sth->bindParam('restaurant_id', $restaurant_id, PDO::PARAM_INT);
            $sth->execute();
            $restauranttyp_ids = $sth->fetchAll(PDO::FETCH_COLUMN);
            //for ($i=0; $i < count($restauranttyp_ids); $i++){
               //echo 'restauranttypids zu restaurant_id :' . $restaurant_id;

           // }


            //Ziel Rückgabe Restauranttyp-Objekt
            //$restauranttyp = Restauranttyp::getById($restauranttyp_id);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
        return $restauranttyp_ids;
    }
}