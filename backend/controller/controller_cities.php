<?php

//Класс контроллера работы со справочником "Города"
class Controller_Cities extends Controller
{
    //Метод вывода страницы стправочника "Города"
    public function index() {
        $model = new Model_Cities();
        $dataCities = $model->getCountryList();
        $viewer = new Viewer_Cities();
        $viewer->rend("constructCitiesList.php", $dataCities);
    }

    //Метод загрузки городов из БД MySQL в grid.js через json
    public function loadData() {
        $model = new Model_Cities();
        $listCities = $model->loadData();
        header("Content-Type: application/json");
        echo json_encode($listCities);
    }

    //Метод записи города в БД
    public function insertCity() {
        $model = new Model_Cities();
        $insertedCity = $model->insertCity();
        header("Content-Type: application/json");
        echo json_encode($insertedCity);
    }

    //Метод изменения города в БД
    public function editCity() {
        $model = new Model_Cities();
        $checkStatus = $model->editCity();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }

    //Метод удаления города из БД
    public function deleteCity() {
        $model = new Model_Cities();
        $checkStatus = $model->deleteCity();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }
}