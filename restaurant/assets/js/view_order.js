  var count = 0;
  var last_code; //for keep last food order code
  var totalprice;

  //get all order details
  $.ajax({
    url: "http://localhost/restaurant/dataAccess/orders.php",
    method: "GET",
    dataType: 'JSON',
    cache: false,
    success: function(roworder) {
      roworder.forEach(function(rowo) {
        count++;
        //store last order code
        last_code = rowo.code;
        //store last order total price
        totalprice = rowo.total_price;
      });
      $('#total').append(totalprice);

      //get food id s relevant to the stored last code
      $.ajax({
        url: "http://localhost/restaurant/dataAccess/order_foods.php?code=" + last_code,
        method: "GET",
        dataType: 'JSON',
        cache: false,
        success: function(roworderfood) {

           //get all foods details 
          $.ajax({
            url: "http://localhost/restaurant/dataAccess/foods.php",
            method: "GET",
            dataType: 'JSON',
            cache: false,
            //filter out last order details from many tany tables
            success: function(rowfood) {
              roworderfood.forEach(function(rowof) {
                rowfood.forEach(function(rowf) {

                  //display food details of last order only
                  if (rowof.food_id == rowf.food_id) {
                    $('#orders').append('<tr style="height: 30px">');
                    $('#orders').append('<td>' + rowof.code + '</td>');
                    $('#orders').append('<td>' + rowf.food_name + '</td>');
                    $('#orders').append('<td>Rs. ' + rowf.price + '.00</td>');
                    $('#orders').append('</tr>');
                  }
                });
              });
            },
            error: function(rowfood) {}
          });
        },
        error: function(roworderfood) {}
      });
    },
    error: function(roworder) {}
  });