<?php

//Класс модели.Логика работы со карточкой конкретного адреса.
class Model_DelectusCard
{
    //Метод получения данных конкретной карточки адреса, из базы данных
    public function loadData() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $tempQueryDelectus = "SELECT id_delectus AS id, catalog_received AS catalogReceived,"
            ." number_delectus AS numberDelectus, order_sent AS orderSent, seeds_obtained AS seedsObtained,"
            ." amount_obtained AS amountObtained, seeds_sent AS seedsSent, amount_sent AS amountSent,"
            ." id_address AS idAddress FROM delectus WHERE id_address=:idAddress";
        $queryDelectus = $pdo->prepare($tempQueryDelectus);
        $queryDelectus->bindParam(":idAddress", $_POST[idAddress]);
        $queryDelectus->execute();
        $data = $queryDelectus->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

    //Метод записи строки данных для конкретной карточки адреса в БД
    public function insertDelectus() {
        $pdo = new PDO(DSN, DB_USERNAME,DB_PASSWORD);
        $queryInsDelectus = $pdo->prepare("INSERT INTO delectus "
            ."(catalog_received, number_delectus, order_sent, seeds_obtained, amount_obtained, seeds_sent, amount_sent, id_address)"
            ." VALUES "
            ."(:catalogReceived, :numberDelectus, :orderSent, :seedsObtained, :amountObtained, :seedsSent, :amountSent, :idAddress)");
        $queryInsDelectus->bindParam(":catalogReceived", $_POST[catalogReceived]);
        $queryInsDelectus->bindParam(":numberDelectus", $_POST[numberDelectus]);
        $queryInsDelectus->bindParam(":orderSent", $_POST[orderSent]);
        $queryInsDelectus->bindParam(":seedsObtained", $_POST[seedsObtained]);
        $queryInsDelectus->bindParam(":amountObtained", $_POST[amountObtained]);
        $queryInsDelectus->bindParam(":seedsSent", $_POST[seedsSent]);
        $queryInsDelectus->bindParam(":amountSent", $_POST[amountSent]);
        $queryInsDelectus->bindParam(":idAddress", $_POST[idAddress]);
        $queryInsDelectus->execute();

        $queryLastId = $pdo->prepare("SELECT id_delectus AS id, catalog_received AS catalogReceived,"
            ." number_delectus AS numberDelectus, order_sent AS orderSent, seeds_obtained AS seedsObtained,"
            ." amount_obtained AS amountObtained, seeds_sent AS seedsSent, amount_sent AS amountSent,"
            ." id_address AS idAddress".
            " FROM delectus WHERE id_delectus = :id");
        $queryLastId->bindParam(":id", $pdo->lastInsertId());
        $queryLastId->execute();
        $result = $queryLastId->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    //Метод изменения строки данных для конкретной карточки адреса в БД
    public function editDelectus() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $queryEditDelectus = $pdo->prepare("UPDATE delectus SET ".
            "catalog_received = :catalogReceived, ".
            "number_delectus = :numberDelectus, ".
            "order_sent = :orderSent, ".
            "seeds_obtained = :seedsObtained, ".
            "amount_obtained = :amountObtained, ".
            "seeds_sent = :seedsSent, ".
            "amount_sent = :amountSent ".
            "WHERE id_delectus = :id");
        $queryEditDelectus->bindParam(":id", $_POST[id]);
        $queryEditDelectus->bindParam(":catalogReceived", $_POST[catalogReceived]);
        $queryEditDelectus->bindParam(":numberDelectus", $_POST[numberDelectus]);
        $queryEditDelectus->bindParam(":orderSent", $_POST[orderSent]);
        $queryEditDelectus->bindParam(":seedsObtained", $_POST[seedsObtained]);
        $queryEditDelectus->bindParam(":amountObtained", $_POST[amountObtained]);
        $queryEditDelectus->bindParam(":seedsSent", $_POST[seedsSent]);
        $queryEditDelectus->bindParam(":amountSent", $_POST[amountSent]);
        $queryEditDelectus->execute();
        return null;
    }

    //Метод удаления строки данных из конкретной карточки адреса в БД
    public function deleteDelectus() {
        $pdo = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
        $statementDelete = $pdo->prepare("DELETE FROM delectus WHERE id_delectus = :id");
        $statementDelete->bindParam(":id", $_POST[id]);
        $statementDelete->execute();
        return null;
    }
}