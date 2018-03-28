$(function () {
    $("#jsGridCountries").jsGrid({
        height: "400px",
        width: "100%",
        inserting: true,
        editing: true,
        filtering: true,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 10,
        pageButtonCount: 5,

        controller: {
            loadData: function() {
                return $.ajax({
                    type: "POST",
                    url: "/Countries/loadData"
                });
            },
            insertItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/Countries/insertCountry",
                    data: item
                });
            },
            updateItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/Countries/editCountry",
                    data: item
                });
            },
            deleteItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/Countries/deleteCountry",
                    data: item
                });
            }
        },

        fields: [
            {name: "countryName", title: "Страны:", type: "text", width: 150},
            {name: "countryCod", title: "Код страны:", type: "text", width: 150},
            {type: "control"}
        ]
    });
});