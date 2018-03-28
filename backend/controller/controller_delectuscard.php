<?php

//Класс контроллера работы с карточкой конкретного адреса
class Controller_DelectusCard extends Controller
{
    //Метод вывода страницы карточки адреса
    public function index() {
        $this->viewer->rend("delectusCard.php");
    }

    //Метод загрузки записей карточки из БД MySQL в grid.js через json
    public function loadData() {
        $model = new Model_DelectusCard();
        $listDelectus = $model->loadData();
        header("Content-Type: application/json");
        echo json_encode($listDelectus);
    }

    //Метод записи строки движения семян в БД
    public function insertDelectus() {
        $model = new Model_DelectusCard();
        $insertedDelectus = $model->insertDelectus();
        header("Content-Type: application/json");
        echo json_encode($insertedDelectus);
    }

    //Метод редактирования строки движения семян в БД
    public function editDelectus() {
        $model = new Model_DelectusCard();
        $checkStatus = $model->editDelectus();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }

    //Метод удаления строки движения семян в БД
    public function deleteDelectus() {
        $model = new Model_DelectusCard();
        $checkStatus = $model->deleteDelectus();
        header("Content-Type: application/json");
        echo json_encode($checkStatus);
    }
}