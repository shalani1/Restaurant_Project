//sub menu content change
$('a').on('click', function() {
  var target = $(this).attr('rel');
  $("#" + target).show().siblings("div").hide();
});

//change visibility of pages according to the sub menu
function updateFormDisplay() {
  document.getElementById('updateUsers').style.display = "block";
  document.getElementById('user_details').style.display = "none";
}

//get all user details
$.ajax({
  url: "http://localhost/restaurant/dataAccess/users.php",
  method: "GET",
  dataType: 'JSON',
  cache: false,
  success: function(response) {
    response.forEach(function(row) {
      $('#users').append('<tr class="table-active">');
      $('#users').append('<td>' + row.user_id + '</td>');
      $('#users').append('<td>' + row.name + '</td>');
      $('#users').append('<td>' + row.role + '</td>');
      $('#users').append('<td>' + row.username + '</td>');
      $('#users').append('<td>' + row.password + '</td>');
      $('#users').append('<td>' + row.created_in + '</td>');
      $('#users').append('<td><button type="submit" name="btnUpdate" onclick="updateFormDisplay()" class="btn btn-warning btnUpdate" data-id="' + row.user_id + '">Update</button></td>');
      $('#users').append('<td><button type="submit" name="btnDelete" class="btn btn-danger btnDelete" data-id="' + row.user_id + '">Delete</button></td>');
      $('#users').append('<tr>');
    });
  },
  error: function(response) {}
});

//append user data to textboxes to update
$('#users').on('click', '.btnUpdate', function(event) {
  event.preventDefault();
  $('#user_id').val($(this).data('id'));
  var id = $('#user_id').val();

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/users.php?user_id=" + id,
    method: "GET",
    dataType: "JSON",
    success: function(row) {
      $('#names').append('<input type="text" name="name" class="form-control" id="name2" value="' + row.name + '" required>');
      $('#role_selected2').val(row.role);
      $('#usernames').append('<input type="text" name="username" class="form-control" id="username2" value="' + row.username + '" required>');
      $('#passwords').append('<input type="text" name="password" class="form-control" id="password2" value="' + row.password + '" required>');
    }
  });
});

//update user details
$('#updateUsers').on("submit", function(event) {
  event.preventDefault();
  var user_id = $('#user_id').val();
  var name = $('#name2').val();
  var role = $('#role_selected2').children("option:selected").val();
  var username = $('#username2').val();
  var password = $('#password2').val();

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/users.php?user_id=" + user_id + "&name=" + name + "&role=" + role + "&username=" + username + "&password=" + password,
    method: "PUT",
    dataType: "JSON",
    success: function(response) {
      swal({
        title: "Completed",
        text: "User successfuly Updated!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  });
});

//delete users
$('#users').on('click', '.btnDelete', function(event) {
  event.preventDefault();
  var id = $(this).data('id');

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/users.php?user_id=" + id,
    method: "DELETE",
    dataType: "JSON",
    success: function(response) {
      swal({
        title: "Completed",
        text: "User successfuly Deleted!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  })
});

//add new users
$('#addUsers').on("submit", function(event) {
  event.preventDefault();

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/users.php",
    method: "POST",
    dataType: "JSON",
    data: $('#addUsers').serialize(),
    success: function(response) {
      swal({
        title: "Completed",
        text: "User successfuly Added!",
        type: "success"
      }).then(function() {
        location.reload();
      });
    }
  });
});