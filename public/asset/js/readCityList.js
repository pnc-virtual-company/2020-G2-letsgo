$(document).ready(function () {
    read();

    function read() {
        if (sessionStorage.getItem('country') === null) {
            $.ajax({
                url: "https://raw.githubusercontent.com/russ666/all-countries-and-cities-json/6ee538beca8914133259b401ba47a550313e8984/countries.json",
                method: 'GET',
                dataType: 'json',
                success: function (respone) {
                    sessionStorage.setItem('country', JSON.stringify(respone));
                    var data = listCounty('country');
                    getResult(data)
                }
            });
        } else {
            var data = listCounty('country');
            getResult(data);
        }
    }
});

// list of country and city.
function listCounty(data) {
    return JSON.parse(sessionStorage.getItem(data));
}
// display result
function getResult(data) {
    var option = "";
    const ONLY_COUNTRIES = ['Cambodia', 'Thailand', 'France', 'Canada', 'Vietnam', 'Japan'];
    if (sessionStorage.getItem('output') === null) {
        for (let indexOfCountriies = 0; indexOfCountriies < ONLY_COUNTRIES.length; indexOfCountriies++) {
            for (var countreis in data) {
                if (ONLY_COUNTRIES[indexOfCountriies] === countreis) {
                    var innerArray = data[countreis];
                    innerArray.forEach(province => {
                        option += "<option value=" + countreis + "," + province + ">" + countreis + "," + province + "</option>";
                    });
                }
            }
        }
        sessionStorage.setItem('output', option)
        $('#select').append(option);
      } else {
        $('#select').append(sessionStorage.getItem('output'));
    }
}
