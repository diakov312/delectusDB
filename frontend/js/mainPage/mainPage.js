; (function () {

    //События выбора страны
    var countriesInput = document.getElementById("countriesListId");
    countriesInput.addEventListener("change", getDataFilter);

    var countriesButton = document.getElementsByName("");

    //Событие выбора города
    var citiesInput = document.getElementById("citiesListId");
    citiesInput.addEventListener("change", getDataFilter);

    //Событие выбора организации
    var organizationInput = document.getElementById("organizationsListId");
    organizationInput.addEventListener("change", getDataFilter);

    //Событие добавления страны
    var addCountry = document.getElementById("buttAddCountry");
    addCountry.addEventListener("click", addCountryFunc);

    //Событие добавления города
    var addCity = document.getElementById("buttAddCity");
    addCity.addEventListener("click", addCityFunc);

    //Событие добавления организации
    var addOrganization = document.getElementById("buttAddOrganization");
    addOrganization.addEventListener("click", addOrganizationFunc);

    //Событие добавления адреса
    var addAddress = document.getElementById("buttAddAddress");
    addAddress.addEventListener("click", addAddressFunc);

    //Отслеживание клика на адресе и отправка данных на DelectusCard
    $("body").on("click", ".addressElement", function (e) {
        sendAddressInf($(this).data());
    })
}());