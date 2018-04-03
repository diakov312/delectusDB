<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/frontend/css/jsgrid.min.css">
    <link rel="stylesheet" href="/frontend/css/jsgrid-theme.min.css">
    <title>Города</title>
</head>
<body>
    <label for="inputCountriesFilter">Страна:</label>
    <input id="inputCountriesFilter" list="countriesList" type="text" value="%1$s">
    <datalist id="countriesList">
        %2$s
    </datalist>
    <h1>Справочник городов:</h1>
    <div id="jsGridCities"></div>
    <a href="/Main/index">Главная</a>

    <script src="/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="/frontend/js/jsgrid.js"></script>
    <script src="/frontend/js/jsgrid.min.js"></script>
    <script src="/frontend/js/citiesList/citiesOptionGrid.js"></script>
    <script src="/frontend/js/citiesList/gridFirstInit.js"></script>
    <script src="/frontend/js/citiesList/citiesList.js"></script>
</body>
</html>