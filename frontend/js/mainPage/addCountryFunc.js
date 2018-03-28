//функция внесения страны в б.д. и проверки корректности ввода
function addCountryFunc() {
    var countrySelect = document.getElementById("countriesListId").value;

    if (countrySelect !== "") {
        var requestCountrySelect = $.ajax({
            url: "/Main/addCountry",
            method: "POST",
            data: {countrySelect: countrySelect},
            dataType: "json"
        });

        requestCountrySelect.done(function (obj) {
            if (obj !== "CountryAdded") {
                alert("Страна " + obj + " уже есть в базе данных!");
            } else {
                console.log("Страна " + countrySelect + " добавлена!");
            }
        })
    } else {
        alert("Введите название страны!");
    }
}