
        $(document).ready(function(){
           read();
           function read(){
             if (sessionStorage.getItem('country')===null) {
                $.ajax({
                  url:"{{route('event.read')}}",
                  method:'GET',
                  dataType:'json',
                  success:function(respone)
                  {
                    sessionStorage.setItem('country',respone);
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
          for (var countreis in data) {
            var innerArray = data[countreis];
            innerArray.forEach(province => {
              option += ` <option value="${countreis} , ${province}">${countreis} , ${province}</option>`;
            });
          }
        $('#select').append(option);
      }