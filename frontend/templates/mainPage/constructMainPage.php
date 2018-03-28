<?php

$listCountryOptions = "";
$listCityOptions = "";
$listOrganizationOptions = "";

if ($data !== null) {
    foreach ($data["Countries"] as $value) {
        $currCountryOption = sprintf(file_get_contents("frontend/templates/mainPage/tempSoloOption.temp")
        , $value);
        $listCountryOptions = $listCountryOptions.$currCountryOption;
    }

    foreach ($data["Cities"] as $value) {
        $currCityOptions = sprintf(file_get_contents("frontend/templates/mainPage/tempSoloOption.temp")
            , $value);
        $listCityOptions = $listCityOptions.$currCityOptions;
    }

    foreach ($data["Organization"] as $value) {
        $currOrganizationOptions = sprintf(file_get_contents("frontend/templates/mainPage/tempSoloOption.temp")
            , $value);
        $listOrganizationOptions = $listOrganizationOptions.$currOrganizationOptions;
    }

    $tempMainPage = sprintf(file_get_contents("frontend/templates/mainPage/MainPage.php")
        , $listCountryOptions, $listCityOptions, $listOrganizationOptions);
}

echo $tempMainPage;