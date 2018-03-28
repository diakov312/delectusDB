<?php

//Класс модели.Логика работы со справочником организаций.
class Model_Organizations extends Model
{
    //Метод получения данных организаций, из базы данных
    public function loadData() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $data = $pdo
            ->query("SELECT id_organization, name_organization AS organizationName, org.id_city AS idCity, cod_country AS countryCod "
            ."FROM organization org "
            ."JOIN cities ci ON org.id_city=ci.id_city "
            ."JOIN country co ON ci.id_country=co.id_country")
        ->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    //Метод записи данных организации в БД
    public function insertOrganization() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryInsOrg = $pdo->prepare("INSERT INTO organization (name_organization, id_city) VALUES (:organizationName, :idCity)");
        $queryInsOrg->bindParam(":organizationName", $_POST[organizationName]);
        $queryInsOrg->bindParam(":idCity", $_POST[idCity]);
        $queryInsOrg->execute();

        $queryLastId = $pdo->prepare("SELECT id_organization, name_organization AS organizationName,"
            ." org.id_city AS idCity, cod_country AS countryCod "
            ."FROM organization org "
            ."JOIN cities ci ON org.id_city=ci.id_city "
            ."JOIN country co ON ci.id_country=co.id_country "
            ."WHERE id_organization=:id");
        $queryLastId->bindParam(":id", $pdo->lastInsertId());
        $queryLastId->execute();
        $result = $queryLastId->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //Метод изменения данных организации в БД
    public function editOrganization() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $queryEditCountry = $pdo->prepare("UPDATE organization SET ".
            "name_organization = :organizationName, ".
            "id_city = :idCity ".
            "WHERE id_organization = :id");
        $queryEditCountry->bindParam(":id", $_POST[id_organization]);
        $queryEditCountry->bindParam(":organizationName", $_POST[organizationName]);
        $queryEditCountry->bindParam(":idCity", $_POST[idCity]);
        $queryEditCountry->execute();
        return null;
    }

    //Метод удаления организации из БД
    public function deleteOrganization() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $statementDelete = $pdo->prepare("DELETE FROM organization WHERE id_organization = :id");
        $statementDelete->bindParam(":id", $_POST[id_organization]);
        $statementDelete->execute();
        return null;
    }
}