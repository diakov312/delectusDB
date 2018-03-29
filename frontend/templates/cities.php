<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/frontend/css/jsgrid.min.css">
    <link rel="stylesheet" href="/frontend/css/jsgrid-theme.min.css">
    <title>Города</title>
</head>
<body>
<h1 >Страна: <?php echo $_POST[nameCountry] ?></h1>
<h1>Справочник городов:</h1>
<div id="jsGridCities"></div>
<a href="/Main/index">Главная</a>

<script src="/frontend/js/jquery-3.3.1.min.js"></script>
<script src="/frontend/js/jsgrid.js"></script>
<script src="/frontend/js/jsgrid.min.js"></script>
<script src="/frontend/js/referensBooks/citiesOptionGrid.js"></script>
</body>
</html>