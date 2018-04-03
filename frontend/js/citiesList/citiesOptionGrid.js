//Основные настройки грида справочника городов
function citiesGrid (countryFilter) {
    $.ajax({
        type: "POST",
        url: "/Countries/loadData"
    }).done(function (countries) {

        $("#jsGridCities").jsGrid({
            height: "400px",
            width: "100%",
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,

            controller: {
                loadData: function() {
                    return $.ajax({
                        data: {countryFilter: countryFilter},
                        type: "POST",
                        url: "/Cities/loadData"
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Cities/insertCity",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Cities/editCity",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Cities/deleteCity",
                        data: item
                    });
                }
            },

            fields: [
                {name: "cityName", title: "Город:", type: "text", width: 150},
                {name: "countryId", title: "Страна:", type: "select",items: countries, width: 150,
                    valueField: "id_country", textField: "countryName"},
                {type: "control"}
            ]
        });
    });
}