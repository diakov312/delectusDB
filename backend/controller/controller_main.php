<?php

//Класс контроллера работы со главной страницей
class Controller_Main extends Controller
{
    //Метод вывода главной страницы
    public function index() {
        $model = new Model_Main();
        $dataMainPage = $model->getDataMainPage();
        $viewerMain = new Viewer_Main();
        $viewerMain->rend("constructMainPage.php", $dataMainPage);
    }

    //Метод получения данных полей фильтров(страны, города, организации) и адресов после изменения фильтров
    public function getDataChangesFilter() {
        $model = new Model_Main();
        $data = $model->getDataChangesFilter();
        $viewerMain = new Viewer_Main();
        echo $viewerMain->getJson($data);
    }

    //Метод добавления страны с главной страницы
    public function addCountry() {
        $model = new Model_Main();
        $checkCountry = $model->addCountry();
        $viewerMain = new Viewer_Main();
        echo $viewerMain->getJson($checkCountry);
    }

    //метод добавлениягорода с главной страницы
    public function addCity() {
        $model = new Model_Main();
        $checkCity = $model->addCity();
        $viewerMain = new Viewer_Main();
        echo $viewerMain->getJson($checkCity);
    }

    //метод добавления организации с главной страницы
    public function addOrganization() {
        $model = new Model_Main();
        $checkOrganization = $model->addOrganization();
        $viewerMain = new Viewer_Main();
        echo $viewerMain->getJson($checkOrganization);
    }

    //Метод добавления адреса с главной страницы
    public function addAddress() {
        $model = new Model_Main();
        $checkAddress = $model->addAddress();
        $viewerMain = new Viewer_Main();
        echo $viewerMain->getJson($checkAddress);
    }
}