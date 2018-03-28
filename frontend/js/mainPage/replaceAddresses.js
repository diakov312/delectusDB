//функция формирования списка адресов
function replaceAddresses(data) {
    var tempAddrList = "";
    data.forEach(function (item) {
        tempAddrList = tempAddrList + "<form><div class='addressElement'"
            + " data-idAddress='"+ item.id_address
            + "' data-valueAddress='" + item.value_address
            + "' data-nameOrganization='" + item.name_organization
            + "' data-nameCity='" + item.name_city
            + "' data-nameCountry='" + item.name_country
            + "'><div class='cellAddressElement'><h3>Адресс:</h3><span>" + item.value_address + "</span></div>"
            + "<div class='cellAddressElement'><h3>Организация:</h3><span>" + item.name_organization + "</span></div>"
            + "<div class='cellAddressElement'><h3>Город:</h3><span>" + item.name_city + "</span></div>"
            + "<div class='cellAddressElement'><h3>Страна:</h3><span>" + item.name_country + "</span></div></div></form>";
    });
    document.getElementById("addressesList").innerHTML = tempAddrList;
}