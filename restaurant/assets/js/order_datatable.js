//ajax call for get order details in orders table
$.ajax({
  url: "http://localhost/restaurant/dataAccess/orders.php",
  method: "GET",
  dataType: 'JSON',
  cache: false,
  success: function(roworder) {

    //ajax call for get food id s of each order in order_foods table
    $.ajax({
      url: "http://localhost/restaurant/dataAccess/order_foods.php",
      method: "GET",
      dataType: 'JSON',
      cache: false,
      success: function(roworderfood) {

        //ajax call for get food names relevant to the food id s in foods table .
        $.ajax({
          url: "http://localhost/restaurant/dataAccess/foods.php",
          method: "GET",
          dataType: 'JSON',
          cache: false,
          success: function(rowfood) {

            //ajax call for get waiter name who place the order in users table
            $.ajax({
              url: "http://localhost/restaurant/dataAccess/users.php",
              method: "GET",
              dataType: 'JSON',
              cache: false,
              success: function(rowuser) {

                roworder.forEach(function(rowo) {
                  roworderfood.forEach(function(rowof) {
                    rowfood.forEach(function(rowf) {
                      rowuser.forEach(function(rowu) {
                        if (rowo.code == rowof.code) {
                          if (rowof.food_id == rowf.food_id) {
                            if (rowo.user_id == rowu.user_id) {
                              $('#orders').append('<tr style="height: 20px">>');
                              $('#orders').append('<td>' + rowof.code + '</td>');
                              $('#orders').append('<td>' + rowf.food_name + '</td>');
                              $('#orders').append('<td>Rs. ' + rowf.price + '.00</td>');
                              $('#orders').append('<td>' + rowo.order_date + '</td>');
                              $('#orders').append('<td>' + rowu.name + '</td>');
                              $('#orders').append('<td><button type="submit" name="btnDelete" class="btn btn-danger btnDelete" data-id="' + rowof.id + '">Delete</button></td>');
                              $('#orders').append('</tr>');
                            }
                          }
                        }
                      });
                    });
                  });
                });
              },
              error: function(rowuser) {}
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

//delete orders
$('#orders').on('click', '.btnDelete', function(event) {
  event.preventDefault();
  var id = $(this).data('id');

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/order_foods.php?id=" + id,
    method: "DELETE",
    dataType: "JSON",
    success: function(response) {
      swal({
        title: "Completed",
        text: "Order successfuly Deleted!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  })
});