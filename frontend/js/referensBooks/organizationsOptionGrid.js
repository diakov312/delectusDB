$(function () {
    $.ajax({
        type: "POST",
        url: "/Cities/loadData"
    }).done(function (city) {

        $("#jsGridOrganizations").jsGrid({
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
                        type: "POST",
                        url: "/Organizations/loadData"
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Organizations/insertOrganization",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Organizations/editOrganization",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Organizations/deleteOrganization",
                        data: item
                    });
                }
            },

            fields: [
                    {name: "organizationName", title: "Организация:", type: "text", width: 150},
                {name: "idCity", title: "Город:", type: "select",items: city, width: 150,
                    valueField: "id_city", textField: "cityName"},
                {name: "countryCod", title: "Код страны:", width: 150},
                {type: "control"}
            ]
        });
    });
});