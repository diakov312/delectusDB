$(function () {
    $.ajax({
        type: "POST",
        url: "/Organizations/loadData"
    }).done(function (organizations) {

        $("#jsGridAddresses").jsGrid({
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
                        url: "/Addresses/loadData"
                    });
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Addresses/insertAddress",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Addresses/editAddress",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "/Addresses/deleteAddress",
                        data: item
                    });
                }
            },

            fields: [
                {name: "addressName", title: "Адрес:", type: "text", width: 350},
                {name: "organizationId", title: "Организация:", type: "select",items: organizations, width: 150,
                    valueField: "id_organization", textField: "organizationName"},
                {type: "control"}
            ]
        });
    });
});