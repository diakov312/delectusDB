<?php

//Основной класс контроллеров. Является родителем для остальных
class Controller
{
    public $viewer;

    function __construct()
    {
        $this->viewer = new Viewer();
    }
}