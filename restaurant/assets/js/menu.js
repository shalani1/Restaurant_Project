//get food details to display in the table
$.ajax({
    url: "http://localhost/restaurant/dataAccess/foods.php",
    method: "GET",
    dataType: 'JSON',
    cache: false,
    success: function(response) {
        response.forEach(function(row) {
            $('#food').append('<tr class="table-active" style="height: 30px">');
            $('#food').append('<th scope="row">' + row.food_name + '</th>');
            $('#food').append('<td>Rs. ' + row.price + '.00</td>');
            $('#food').append('<input type="checkbox" name="foods[]" style="height:30px;width:30px;" value="' + row.food_id + '">');
            $('#food').append('<tr>');
        });
    },
    error: function(response) {}
});

//prevent go foward without select foods
$("#button").click(function() {
    var checked = $("#items input[type=checkbox]:checked").length;
    if (checked == 0) {
        alert("Please select food items");
        return false;
    }
});