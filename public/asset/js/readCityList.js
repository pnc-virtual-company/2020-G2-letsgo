
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
    $(document).on('keyup', '#autoSuggestion', function(){
        var search = $(this).val();
        if(search == ""){
            return "fail";
        }else {
            var regex = new RegExp(search, 'i');
            var result ='';    
            for (var key in data) {
                var val = data[key];
                if(key.search(regex) != -1){
                    result += `<option value="${key}">${key}</option>`; 
                    if (search == key) {
                            val.forEach((element,i) => {
                                if(i < 80){
                                    result += `<option value="${key},${element}">${key},${element}</option>`;
                                }
                                i++;
                            });
                    }
                } 
            }      
            $('#result').html(result);
        }      
    });
    
}
