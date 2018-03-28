//функция внесения города в б.д. и проверки корректности ввода
function addCityFunc() {
    var countrySelect = document.getElementById("countriesListId").value;
    var citySelect = document.getElementById("citiesListId").value;

    if (countrySelect !== "") {
        if (citySelect !== "") {
            var requestCitySelect = $.ajax({
                url: "/Main/addCity",
                method: "POST",
                data: {countrySelect: countrySelect, citySelect: citySelect},
                dataType: "json"
            });

            requestCitySelect.done(function (obj) {
                switch (obj) {
                    case "CountryNotInDB":
                        alert("Страны " + countrySelect + " отсутствует в базе данных!");
                        break;
                    case "CityInDB":
                        alert("Город " + citySelect + " уже есть в стране " + countrySelect + "!");
                        break;
                    case "CityAdded":
                        console.log("Город " + citySelect + " добавлен в базу данных!");
                        break;
                    default:
                        console.log("Ошибка записи значения!");
                }
            })
        } else {
            alert("Введите название города!");
        }
    } else {
        alert("Выберите название страны!");
    }
}