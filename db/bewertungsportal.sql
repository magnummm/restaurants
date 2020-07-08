--DDL data definition language bezieht sich auf die Struktur
DROP DATABASE IF EXISTS bewertungsportal;

CREATE DATABASE bewertungsportal;
USE bewertungsportal;

CREATE TABLE restaurant(id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(45),
    plz VARCHAR(5),
    ort VARCHAR(45),
    strassehausnummer VARCHAR(45),
    eroeffnungsdatum DATE,
    preiskategorie INT NOT NULL);

CREATE TABLE restauranttyp(id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(45));

CREATE TABLE restaurant_restauranttyp(id INT PRIMARY KEY AUTO_INCREMENT, restaurant_id INT, restauranttyp_id INT);

ALTER TABLE restaurant_restauranttyp ADD FOREIGN KEY fk1_restaurant (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE;
ALTER TABLE restaurant_restauranttyp ADD FOREIGN KEY fk2_restauranttyp (restauranttyp_id) REFERENCES restauranttyp(id) ON DELETE CASCADE;



--DML data manipulation language bezieht sich auf Datensätze
INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
VALUES(NULL, 'Berliner Hof', '12345', 'Berlin', 'Berlinerstr. 42', '2001-12-31', 3);
INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
VALUES(NULL, 'Neuenhagener Hof', '15366', 'Neuenhagen', 'Rudolf-Breidscheidstr. 42', '1978-12-31', 3);
INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
VALUES(NULL, 'Es gibt Reis', '54321', 'Angerburger Moor', 'Forsythienstrasse 138', '2019-10-07', 3);
INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
VALUES(NULL, 'Bergwerk', '28870', 'Ottersberg', 'Quelkhorner Landstrasse 19', '1999-12-31', 3);
INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
VALUES(NULL, 'Zur Rennbahn Hoppegarten', '15366', 'Hoppegarten', 'Zum Haupteingang 01', '1956-12-31', 3);
INSERT INTO restaurant(id, name, plz, ort, strassehausnummer, eroeffnungsdatum, preiskategorie)
VALUES(NULL, 'La Locandiera', '81739', 'München', 'Therese-Giehse-Allee 76', '2005-10-07', 3);

INSERT INTO restauranttyp(id, name)
VALUES(NULL, 'Deutsch');
INSERT INTO restauranttyp(id, name)
VALUES(NULL, 'Sudanesisch');
INSERT INTO restauranttyp(id, name)
VALUES(NULL, 'Spanisch');
INSERT INTO restauranttyp(id, name)
VALUES(NULL, 'ÖkoThai');
INSERT INTO restauranttyp(id, name)
VALUES(NULL, 'Künftigdeftig');

INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id) VALUES (NULL, 1, 4);
INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id) VALUES (NULL, 2, 5);
INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id) VALUES (NULL, 4, 2);
INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id) VALUES (NULL, 3, 1);
INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id) VALUES (NULL, 6, 3);
INSERT INTO restaurant_restauranttyp(id, restaurant_id, restauranttyp_id) VALUES (NULL, 5, 5);

CREATE TABLE user(id INT PRIMARY KEY AUTO_INCREMENT,
                username VARCHAR(45) NOT NULL,
                password VARCHAR(45) NOT NULL,
                rolle VARCHAR (45) NOT NULL );

INSERT INTO user(id, username, password, rolle)
VALUES(NULL, 'user1', SHA('123'),'reguser');
INSERT INTO user(id, username, password, rolle)
VALUES(NULL, 'user2', SHA('456'), 'reguser');
INSERT INTO user(id, username, password, rolle)
VALUES(NULL, 'user3', SHA('789'), 'reguser');
INSERT INTO user(id, username, password, rolle)
VALUES(NULL, 'a', SHA('s'), 'admin');



CREATE TABLE bewertung(id INT PRIMARY KEY AUTO_INCREMENT, note INT, restaurant_id INT, user_id INT, kommentar VARCHAR (100));

ALTER TABLE bewertung ADD FOREIGN KEY fk1_user (user_id) REFERENCES user(id) ON DELETE CASCADE;
ALTER TABLE bewertung ADD FOREIGN KEY fk2_restaurant (restaurant_id) REFERENCES restaurant(id) ON DELETE CASCADE ;

INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 1, 1, 1, 'dufte');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 2, 2, 2, 'jut');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 3, 3, 3, 'jeht so');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 5, 4, 4, 'hmmm');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 1, 2, 1, 'nich wirklich');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 3, 3, 2, 'unsinn');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 3, 4, 3, 'unsinniger');
INSERT INTO bewertung(id, note, restaurant_id, user_id, kommentar)
VALUES(NULL, 5, 5, 4, 'katastrophe');






