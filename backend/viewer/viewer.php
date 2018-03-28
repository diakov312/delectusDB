<?php

//Класс обработки всех страниц для отображения
class Viewer
{
    public function rend($template) {
        ob_start();
        include "frontend/templates/".$template;
        $content = ob_get_contents();
        return $content;
    }
}