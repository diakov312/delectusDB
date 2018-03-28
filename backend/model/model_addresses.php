<?php
/**
 * Created by PhpStorm.
 * User: diakov312
 * Date: 14.03.2018
 * Time: 12:40
 */

//Класс модели.Логика работы со справочником адресов.
class Model_Addresses
{
    //Метод получения данных адресов, из базы данных
    public function loadData() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryAddresses = $pdo->query("SELECT id_address AS id, value_address AS addressName,"
            ." addr.id_organization AS organizationId, name_organization AS organizationName "
            ."FROM address_organization addr "
            ."JOIN organization org ON addr.id_organization=org.id_organization");
        $dataAddresses = $queryAddresses->fetchAll(PDO::FETCH_OBJ);
        return $dataAddresses;
    }

    //Метод записи данных адреса в БД
    public function insertAddress() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryInsAddr = $pdo->prepare("INSERT INTO address_organization (value_address, id_organization)"
            ." VALUES (:addressName, :organizationId)");
        $queryInsAddr->bindParam(":addressName", $_POST[addressName]);
        $queryInsAddr->bindParam(":organizationId", $_POST[organizationId]);
        $queryInsAddr->execute();

        $queryLastId = $pdo->prepare("SELECT id_address AS id, value_address AS addressName,"
            ." addr.id_organization AS organizationId, name_organization AS organizationName"
            ." FROM address_organization addr"
            ." JOIN organization org ON addr.id_organization=org.id_organization"
            ." WHERE id_address=:id");
        $queryLastId->bindParam(":id", $pdo->lastInsertId());
        $queryLastId->execute();
        $result = $queryLastId->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //Метод изменения данных адреса в БД
    public function editAddress() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $queryEditAddress = $pdo->prepare("UPDATE address_organization SET ".
            "value_address = :addressName, ".
            "id_organization = :organizationId ".
            "WHERE id_address = :idAddres");
        $queryEditAddress->bindParam(":idAddres", $_POST[id]);
        $queryEditAddress->bindParam(":addressName", $_POST[addressName]);
        $queryEditAddress->bindParam(":organizationId", $_POST[organizationId]);
        $queryEditAddress->execute();
        return null;
    }

    //Метод удаления адреса из БД
    public function deleteAddress() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $statementDelete = $pdo->prepare("DELETE FROM address_organization WHERE id_address = :id");
        $statementDelete->bindParam(":id", $_POST[id]);
        $statementDelete->execute();
        return null;
    }
}