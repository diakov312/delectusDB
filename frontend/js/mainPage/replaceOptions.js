//функция замены доступных значений <option> для input
function replaceOptions(data, idElement) {
    var tempSection = "";
    data.forEach(function (item) {
        tempSection = tempSection + "<option value='" + item + "'></option>";
    });
    document.getElementById(idElement).innerHTML = tempSection;
}