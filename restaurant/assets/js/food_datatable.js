//sub menu content change
$('a').on('click', function() {
  var target = $(this).attr('rel');
  $("#" + target).show().siblings("div").hide();
});

//manage visibility of update form and food details table
function updateFormDisplay() {
  document.getElementById('updateFoods').style.display = "block";
  document.getElementById('items').style.display = "none";
}

//retrieve and append all food details in a table to desplay
$.ajax({
  url: "http://localhost/restaurant/dataAccess/foods.php",
  method: "GET",
  dataType: 'JSON',
  cache: false,
  success: function(rowfood) {

    //to get each food aded admin's name
    $.ajax({
      url: "http://localhost/restaurant/dataAccess/users.php",
      method: "GET",
      dataType: 'JSON',
      cache: false,
      success: function(rowuser) {
        rowfood.forEach(function(rowf) {
          rowuser.forEach(function(rowu) {
            if (rowf.user_id == rowu.user_id) {
              $('#food').append('<tr class="table-active"  style="height: 20px">');
              $('#food').append('<th scope="row">' + rowf.food_name + '</th>');
              $('#food').append('<td>Rs. ' + rowf.price + '.00</td>');
              $('#food').append('<td>' + rowu.name + '</td>');
              $('#food').append('<td><button type="submit" onclick="updateFormDisplay()" name="btnUpdate" class="btn btn-warning btnUpdate" data-id="' + rowf.food_id + '">Update</button></td>');
              $('#food').append('<td><button type="submit" name="btnDelete" class="btn btn-danger btnDelete" data-id="' + rowf.food_id + '">Delete</button></td>');
              $('#food').append('<tr>');
            }
          });
        });
      },
      error: function(rowuser) {}
    });

  },
  error: function(rowfood) {}
});

//append food data to textboxes to update
$('#food').on('click', '.btnUpdate', function(event) {
  event.preventDefault();
  $('#food_id').val($(this).data('id'));
  var id = $('#food_id').val();

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/foods.php?food_id=" + id,
    method: "GET",
    dataType: "JSON",
    success: function(row) {
      $('#foodname').append('<input type="text" class="form-control" name="food_names" id="food_names" value="' + row.food_name + '" required>');
      $('#foodprices').append('<input type="text" class="form-control" name="price" id="food_price" value="' + row.price + '" required>');
    }
  });
});

//update foods
$('#update').on("click", function(event) {
  event.preventDefault();
  var food_id = $('#food_id').val();
  var food_name = $('#food_names').val();
  var price = $('#food_price').val();
  var user_id = $('#user_id').val();

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/foods.php?food_id=" + food_id + "&food_name=" + food_name + "&price=" + price + "&user_id=" + user_id,
    method: "PUT",
    dataType: "JSON",
    success: function(response) {
      swal({
        title: "Completed",
        text: "Food successfuly Updated!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  });
});

//delete food
$('#food').on('click', '.btnDelete', function(event) {
  event.preventDefault();
  var id = $(this).data('id');

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/foods.php?food_id=" + id,
    method: "DELETE",
    dataType: "JSON",
    success: function(response) {
      swal({
        title: "Completed",
        text: "Food successfuly Deleted!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  })
});

//add new foods
$('#addFoods').on("submit", function(event) {
  event.preventDefault();

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/foods.php",
    method: "POST",
    dataType: "JSON",
    data: $('#addFoods').serialize(),
    success: function(response) {
      swal({
        title: "Completed",
        text: "Food successfuly Added!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  });
});