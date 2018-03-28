//функция внесения организации в б.д. и проверки корректности ввода
function addOrganizationFunc() {
    var countrySelect = document.getElementById("countriesListId").value;
    var citySelect = document.getElementById("citiesListId").value;
    var organizationSelect = document.getElementById("organizationsListId").value;

    if (countrySelect !== "") {
        if (citySelect !== "") {
            if (organizationSelect !== "") {
                var requestOrganizationSelect = $.ajax({
                    url: "/Main/addOrganization",
                    method: "POST",
                    data: {countrySelect: countrySelect
                        , citySelect: citySelect
                        , organizationSelect: organizationSelect},
                    dataType: "json"
                });

                requestOrganizationSelect.done(function (obj) {
                    switch (obj) {
                        case "CountryNotInDB":
                            alert("Страна " + countrySelect + " отсутствует в базе данных!");
                            break;
                        case "CityNotInDB":
                            alert("Город " + citySelect + " отсутствует в базе данных!");
                            break;
                        case "OrganizationInDB":
                            alert("Организация " + organizationSelect + " уже есть в городе " + citySelect + "!");
                            break;
                        case "OrganizationAdded":
                            console.log("Организация " + organizationSelect + " добавлена в базу данных!");
                            break;
                        default:
                            console.log("Ошибка записи значения!");
                    }
                })
            } else {
                alert("Введите название организации!");
            }
        } else {
            alert("Введите название города!");
        }
    } else {
        alert("Выберите название страны!");
    }
}