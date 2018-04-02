<?php

$listCountryOptions = "";

if ($data !== null) {
    foreach ($data["Countries"] as $value) {
        $currCountryOption = sprintf(file_get_contents("frontend/templates/citiesList/tempSoloOption.temp")
            , $value);
        $listCountryOptions = $listCountryOptions.$currCountryOption;
    }

    $tempCitiesList = sprintf(file_get_contents("frontend/templates/citiesList/cities.php")
        , $listCountryOptions);
}

echo $tempCitiesList;