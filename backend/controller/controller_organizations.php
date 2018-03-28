<?php

//Класс контроллера работы со справочником "Организации"
class Controller_Organizations extends Controller
{
    //Метод вывода страницы стправочника "Организации"
    public function index() {
        $this->viewer->rend("organizations.html");
    }

    //Метод загрузки организаций из БД MySQL в grid.js через json
    public function loadData() {
        $model = new Model_Organizations();
        $listOrganizations = $model->loadData();
        header("Content-Type: application/json");
        echo json_encode($listOrganizations);
    }

    //Метод записи организации в БД
    public function insertOrganization() {
        $model = new Model_Organizations();
        $insertedCity = $model->insertOrganization();
        header("Content-Type: application/json");
        echo json_encode($insertedCity);
    }

    //Метод изменения организации в БД
    public function editOrganization() {
        $model = new Model_Organizations();
        $checkStatus = $model->editOrganization();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }

    //Метод удаления организации из БД
    public function deleteOrganization() {
        $model = new Model_Organizations();
        $checkStatus = $model->deleteOrganization();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }
}