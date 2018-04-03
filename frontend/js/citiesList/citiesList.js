//События выбора страны
var countriesInput = document.getElementById("inputCountriesFilter");
countriesInput.addEventListener("change", function () {
    var countryFilter = document.getElementById("inputCountriesFilter").value;
    citiesGrid(countryFilter);
});