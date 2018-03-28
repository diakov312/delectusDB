//функция получения и замены данных в полях фильтра и списка адресов
function getDataFilter() {
    var countrySelect = document.getElementById("countriesListId").value;
    var citySelect = document.getElementById("citiesListId").value;
    var organizationSelect = document.getElementById("organizationsListId").value;

    var requestCountrySelect = $.ajax({
        url: "/Main/getDataChangesFilter",
        method: "POST",
        data: {countrySelect: countrySelect, citySelect: citySelect, organizationSelect: organizationSelect},
        dataType: "json"
    });

    requestCountrySelect.done(function (obj) {
        replaceOptions(obj.Countries, "countriesList");
        replaceOptions(obj.Cities, "citiesList");
        replaceOptions(obj.Organization, "organizationsList");
        replaceAddresses(obj.Addresses);
    });
}