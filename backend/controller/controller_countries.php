<?php

//Класс контроллера работы со справочником "Страны"
class Controller_Countries extends Controller
{
    //Метод вывода страницы стправочника "Страны"
    public function index() {
        $this->viewer->rend("countries.html");
    }

    //Метод загрузки стран из БД MySQL в grid.js через json
    public function loadData() {
        $model = new Model_Countries();
        $listCountries = $model->loadData();
        header("Content-Type: application/json");
        echo json_encode($listCountries);
    }

    //Метод записи страны в БД
    public function insertCountry() {
        $model = new Model_Countries();
        $insertedCountry = $model->insertCountry();
        header("Content-Type: application/json");
        echo json_encode($insertedCountry);
    }

    //Метод изменения страны в БД
    public function editCountry() {
        $model = new Model_Countries();
        $checkStatus = $model->editCountry();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }

    //Метод удаления страны из БД
    public function deleteCountry() {
        $model = new Model_Countries();
        $checkStatus = $model->deleteCountry();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }
}