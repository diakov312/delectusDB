//функция внесения адреса в б.д. и проверки корректности ввода
function addAddressFunc() {

    var countrySelect = document.getElementById("countriesListId").value;
    var citySelect = document.getElementById("citiesListId").value;
    var organizationSelect = document.getElementById("organizationsListId").value;
    var addressSelect = document.getElementById("addressesListId").value;

    if (countrySelect !== "") {
        if (citySelect !== "") {
            if (organizationSelect !== "") {
                if (addressSelect !== "") {
                    var requestAddressSelect = $.ajax({
                        url: "/Main/addAddress",
                        method: "POST",
                        data: {countrySelect: countrySelect
                            , citySelect: citySelect
                            , organizationSelect: organizationSelect
                            , addressSelect: addressSelect},
                        dataType: "json"
                    });

                    requestAddressSelect.done(function (obj) {
                        switch (obj) {
                            case "CountryNotInDB":
                                alert("Страна " + countrySelect + " отсутствует в базе данных!");
                                break;
                            case "CityNotInDB":
                                alert("Город " + citySelect + " отсутствует в базе данных!");
                                break;
                            case "OrganizationNotInDB":
                                alert("Организация " + organizationSelect + " отсутствует в базе данных!");
                                break;
                            case "AddressInDB":
                                alert("Адрес '" + addressSelect + "' уже есть у выбранной организации!");
                                break;
                            case "AddressAdded":
                                console.log("Адрес '" + addressSelect + "' добавлен в базу данных!");
                                break;
                            default:
                                console.log("Ошибка записи значения!");
                        }
                    });
                } else {
                    alert("Введите адрес!");
                }
            } else {
                alert("Выберите название организации!");
            }
        } else {
            alert("Выберите название города!");
        }
    } else {
        alert("Выберите название страны!");
    }
}