<?php

//Класс контроллера работы со справочником "Адреса"
class Controller_Addresses extends Controller
{
    //Метод вывода страницы справочника "Адреса"
    public function index() {
        $this->viewer->rend("addresses.html");
    }

    //Метод загрузки адресов из БД MySQL в grid.js через json
    public function loadData() {
        $model = new Model_Addresses();
        $listAddresses = $model->loadData();
        header("Content-Type: application/json");
        echo json_encode($listAddresses);
    }

    //Метод записи адреса в БД
    public function insertAddress() {
        $model = new Model_Addresses();
        $insertedAddresse = $model->insertAddress();
        header("Content-Type: application/json");
        echo json_encode($insertedAddresse);
    }

    //Метод изменения адреса в БД
    public function editAddress() {
        $model = new Model_Addresses();
        $checkStatus = $model->editAddress();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }

    //Метод удаления адреса из БД
    public function deleteAddress() {
        $model = new Model_Addresses();
        $checkStatus = $model->deleteAddress();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }
}