<?php

//Класс модели.Логика работы со справочником стран.
class Model_Countries extends Model
{
    //Метод получения данных стран, из базы данных
    public function loadData() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $data = $pdo
            ->query("SELECT id_country, name_country AS countryName, cod_country AS countryCod FROM country")
        ->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    //Метод записи данных страны в БД
    public function insertCountry() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryInsCountry = $pdo->prepare("INSERT INTO country (name_country, cod_country) VALUES (:countryName, :countryCod)");
        $queryInsCountry->bindParam(":countryName", $_POST[countryName]);
        $queryInsCountry->bindParam(":countryCod", $_POST[countryCod]);
        $queryInsCountry->execute();

        $queryLastId = $pdo->prepare("SELECT id_country AS id, name_country AS countryName, cod_country AS countryCod".
            " FROM country WHERE id_country = :id");
        $queryLastId->bindParam(":id", $pdo->lastInsertId());
        $queryLastId->execute();
        $result = $queryLastId->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //Метод изменения данных страны в БД
    public function editCountry() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $queryEditCountry = $pdo->prepare("UPDATE country SET ".
            "name_country = :countryName, ".
            "cod_country = :countryCod ".
            "WHERE id_country = :id");
        $queryEditCountry->bindParam(":id", $_POST[id_country]);
        $queryEditCountry->bindParam(":countryName", $_POST[countryName]);
        $queryEditCountry->bindParam(":countryCod", $_POST[countryCod]);
        $queryEditCountry->execute();
        return null;
    }

    //Метод удаления страны из БД
    public function deleteCountry() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $statementDelete = $pdo->prepare("DELETE FROM country WHERE id_country = :id");
        $statementDelete->bindParam(":id", $_POST[id_country]);
        $statementDelete->execute();
        return null;
    }
}