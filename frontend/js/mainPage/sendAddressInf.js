//Функция формирования значений для отправки в выбранную карточку адреса
function sendAddressInf(data) {
    var idAddress = data.idaddress;
    var valueAddress = data.valueaddress;
    var nameOrganization = data.nameorganization;
    var nameCity = data.namecity;
    var nameCountry = data.namecountry;

    var form = document.getElementById("formSendAddressInf");

    var inputIdAddres = document.createElement("input");
    inputIdAddres.setAttribute("type", "hidden");
    inputIdAddres.setAttribute("name", 'idAddress');
    inputIdAddres.setAttribute("value", idAddress);

    var inputValueAddress = document.createElement("input");
    inputValueAddress.setAttribute("type", "hidden");
    inputValueAddress.setAttribute("name", 'valueAddress');
    inputValueAddress.setAttribute("value", valueAddress);

    var inputNameOrganization = document.createElement("input");
    inputNameOrganization.setAttribute("type", "hidden");
    inputNameOrganization.setAttribute("name", 'nameOrganization');
    inputNameOrganization.setAttribute("value", nameOrganization);

    var inputNameCity = document.createElement("input");
    inputNameCity.setAttribute("type", "hidden");
    inputNameCity.setAttribute("name", 'nameCity');
    inputNameCity.setAttribute("value", nameCity);

    var inputNameCountry = document.createElement("input");
    inputNameCountry.setAttribute("type", "hidden");
    inputNameCountry.setAttribute("name", 'nameCountry');
    inputNameCountry.setAttribute("value", nameCountry);

    form.appendChild(inputIdAddres);
    form.appendChild(inputValueAddress);
    form.appendChild(inputNameOrganization);
    form.appendChild(inputNameCity);
    form.appendChild(inputNameCountry);
    form.submit();
}