$(function () {
    //сохраняем id адреса для формирования первоначальной таблицы
    var idAddress = $("#idAddressCard").data('idaddress');
    //Настройки работы грида для страницы DelectusCard
    $("#jsGridDelectus").jsGrid({
        height: "400px",
        width: "100%",
        inserting: true,
        editing: true,
        filtering: false,
        sorting: true,
        paging: true,
        autoload: true,
        pageSize: 10,
        pageButtonCount: 5,

        controller: {
            loadData: function(item) {
                return $.ajax({
                    data: {idAddress: idAddress},
                    type: "POST",
                    url: "/DelectusCard/loadData"
                });
            },
            insertItem: function(item) {
                item.idAddress = idAddress;
                return $.ajax({
                    type: "POST",
                    url: "/DelectusCard/insertDelectus",
                    data: item
                });
            },
            updateItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/DelectusCard/editDelectus",
                    data: item
                });
            },
            deleteItem: function(item) {
                return $.ajax({
                    type: "POST",
                    url: "/DelectusCard/deleteDelectus",
                    data: item
                });
            }
        },

        fields: [
            {name: "catalogReceived", title: "Делектус получен:", type: "text", width: 150},
            {name: "numberDelectus", title: "№:", type: "text", width: 50},
            {name: "orderSent", title: "Отправлена заявка:", type: "text", width: 150},
            {name: "seedsObtained", title: "Получены семена:", type: "text", width: 150},
            {name: "amountObtained", title: "Кол-во полученных:", type: "text", width: 150},
            {name: "seedsSent", title: "Отправлены семена:", type: "text", width: 150},
            {name: "amountSent", title: "Кол-во отправленных:", type: "text", width: 150},
            {type: "control"}
        ]
    });
});