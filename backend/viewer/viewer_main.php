<?php

//Класс обработки главной страницы для отображения
class Viewer_Main
{
    function rend($template, $data) {
        ob_start();
        include "frontend/templates/mainPage/".$template;
        $content = ob_get_contents();
        return $content;
    }

    public function getJson($data) {
        return json_encode($data);
    }
}