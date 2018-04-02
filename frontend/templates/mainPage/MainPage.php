<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>delectus</title>
    <link rel="stylesheet" href="/frontend/css/mainPageStyle.css">
</head>
<body>
    <h1>Поиск адресов:</h1>

    <div class="labelHeader">
        <label  for="countriesListId">Страна:</label>
    </div>
    <input class="inputHeader" id="countriesListId" type="text" list="countriesList" name="countrySelect">
    <button>Поиск</button>
    <button id="buttAddCountry">Добавить</button>
    <a href="/Countries/index">Справочник стран</a><br>
    <datalist id="countriesList">
        %1$s
    </datalist>

    <div class="labelHeader">
        <label class="labelHeader" for="citiesListId">Город:</label>
    </div>
    <input class="inputHeader" id="citiesListId" type="text" list="citiesList" name="cytiSelect">
    <button>Поиск</button>
    <button id="buttAddCity">Добавить</button>
    <!--<a href="/Cities/index">Справочник городов</a>-->
    <button id="idLinkAddressList">Справочник городов</button><br>
    <datalist id="citiesList">
        %2$s
    </datalist>

    <div class="labelHeader">
        <label class="labelHeader" for="organizationsListId">Организация:</label>
    </div>
    <input class="inputHeader" id="organizationsListId" type="text" list="organizationsList" name="organizationsSelect">
    <button>Поиск</button>
    <button id="buttAddOrganization">Добавить</button>
    <a href="/Organizations/index">Справочник организаций</a><br>
    <datalist id="organizationsList">
        %3$s
    </datalist>

    <div class="labelHeader">
        <label class="labelHeader" for="addressesListId">Адрес:</label>
    </div>
    <input class="inputHeader" id="addressesListId" type="text" list="adressesList" name="addressSelect">
    <button id="buttAddAddress">Добавить</button>
    <a href="/Addresses/index">Справочник адресов</a><br>

    <div id="addressesList" class="addressesListClass">
        <div id="addressElement"></div>
    </div>

    <form action="/DelectusCard/index" method="post" id="formSendAddressInf"></form>
    <form action="/Cities/index" method="post" id="formSendCityListInf"></form>

    <script src="/frontend/js/jquery-3.3.1.min.js"></script>
    <script src="/frontend/js/mainPage/replaceOptions.js"></script>
    <script src="/frontend/js/mainPage/replaceAddresses.js"></script>
    <script src="/frontend/js/mainPage/getDataFilter.js"></script>
    <script src="/frontend/js/mainPage/sendAddressInf.js"></script>
    <script src="/frontend/js/mainPage/addCountryFunc.js"></script>
    <script src="/frontend/js/mainPage/addCitiFunc.js"></script>
    <script src="/frontend/js/mainPage/addOrganizationFunc.js"></script>
    <script src="/frontend/js/mainPage/addAddressFunc.js"></script>
    <script src="/frontend/js/mainPage/mainPage.js"></script>
</body>
</html>