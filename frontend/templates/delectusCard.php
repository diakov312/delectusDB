<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/frontend/css/jsgrid.min.css">
    <link rel="stylesheet" href="/frontend/css/jsgrid-theme.min.css">
    <link rel="stylesheet" href="/frontend/css/delectusPageStyle.css">
    <title>Delectus card</title>
</head>
<body>
<h1>Карточка записей делектусов.</h1>
<h2>Страна: <?php echo $_POST[nameCountry]?></h2><br>
<h2>Город: <?php echo $_POST[nameCity]?></h2><br>
<h2>Организация: <?php echo $_POST[nameOrganization]?></h2><br>
<h2 id="idAddressCard" data-idAddress="<?php echo $_POST[idAddress]?>">Адрес: <?php echo $_POST[valueAddress]?></h2><br>
<nav></nav>
<div id="jsGridDelectus"></div>
<a href="/Main/index">Главная</a>

<script src="/frontend/js/jquery-3.3.1.min.js"></script>
<script src="/frontend/js/jsgrid.js"></script>
<script src="/frontend/js/jsgrid.min.js"></script>
<script src="/frontend/js/delectusCard/delectusOptionGrid.js"></script>
</body>
</html>