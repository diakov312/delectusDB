<?php

//Класс модели.Логика работы со справочником городов.
class Model_Cities
{
    //Метод получения списка стран, для фильтра.
    public function getCountryList() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryCountryList = $pdo->prepare("SELECT name_country FROM country ORDER BY name_country");
        $queryCountryList->execute();
        $dataCountryList = $queryCountryList->fetchAll(PDO::FETCH_COLUMN);
        return array("Countries" => $dataCountryList);
    }

    //Метод получения данных городов, из базы данных
    public function loadData() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryInsCities = $pdo->prepare("SELECT id_city, name_city AS cityName, id_country AS countryId FROM cities");
        $queryInsCities->execute();
        $dataCities = $queryInsCities->fetchAll(PDO::FETCH_OBJ);
        return $dataCities;
    }

    //Метод записи данных города в БД
    public function insertCity() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryInsCountry = $pdo->prepare("INSERT INTO cities (name_city, id_country) VALUES (:cityName, :countryId)");
        $queryInsCountry->bindParam(":cityName", $_POST[cityName]);
        $queryInsCountry->bindParam(":countryId", $_POST[countryId]);
        $queryInsCountry->execute();

        $queryLastId = $pdo->prepare("SELECT id_city AS id, name_city AS cityName, id_country AS countryId".
            " FROM cities WHERE id_city = :id");
        $queryLastId->bindParam(":id", $pdo->lastInsertId());
        $queryLastId->execute();
        $result = $queryLastId->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //Метод изменения данных города в БД
    public function editCity() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $queryEditCountry = $pdo->prepare("UPDATE cities SET ".
            "name_city = :cityName, ".
            "id_country = :countryId ".
            "WHERE id_cities = :id");
        $queryEditCountry->bindParam(":id", $_POST[id]);
        $queryEditCountry->bindParam(":cityName", $_POST[cityName]);
        $queryEditCountry->bindParam(":countryId", $_POST[countryId]);
        $queryEditCountry->execute();
        return null;
    }

    //Метод удаления города из БД
    public function deleteCity() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $statementDelete = $pdo->prepare("DELETE FROM cities WHERE id_city = :id");
        $statementDelete->bindParam(":id", $_POST[id_city]);
        $statementDelete->execute();
        return null;
    }

    //Метод получения стран для фильтра из БД
}