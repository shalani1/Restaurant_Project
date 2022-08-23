<?php
 session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Make Order</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <?php require "nav.php"; ?>
  </head>
  <body>
    <!--Create a randon number(code) for each and every order-->
    <?php $rand=rand();?>
    <div class="container mt-5">
      <h2>Place Order</h2>
      <div class="row mt-5">
        <form action="view_order.php" method="POST" id="orderItems">
          <input type="text" name="user_id" id="user_id" hidden="hidden" value='<?php echo htmlspecialchars($_SESSION["user_id"]); ?>' />
          <!--set random value to hidden text box to send it to database-->
          <input type="text" name="code" hidden="hidden" id="code" value="<?php echo $rand; ?>" />
          <input type="text" name="food_id" hidden="hidden" id="foodx" value="" />
          <p id="price"></p>
          <div class="x" hidden="hidden">
            <p id="foodh"></p>
          </div>
          <div class="col-md-5">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">Food Item</th>
                  <th scope="col">Price</th>
                </tr>
              </thead>
              <tbody id="food">
                <tr class="table-active"></tr>
              </tbody>
            </table>
            <p class="text-info mt-4">
              Total Price: <strong><span id="sum"></span></strong>
            </p>
            <input type="submit" name="button" id="btnSubmit" value="Place Order" class="btn btn-primary mt-3" />
            <input type="button" id="back" value="Cancel" class="btn btn-primary mt-3" />
          </div>
        </form>
      </div>
    </div>
    <!--get foods items id in order as a php array from menu-->
    <?php
      $x=$_POST['foods'];
    ?>
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script type="text/javascript">
var total = "0.0";
var floatTotal = parseFloat(total);
var count = 0;
var foodArray = [];
var len = 0;

window.onload = function() {
  //convert food item php array to json array
  foodArray = <?php echo json_encode($x); ?> ;
  //get length of the food item array.
  len = foodArray.length;
  //loop the food item id array
  for (var i = 0; i < foodArray.length; i++) {
    //calling getFoodDetails() function
    getFoodDetails(foodArray[i], count); //send food id and count as parameters to the getFoodDetails function.
    count++;
  }
};


//when click back button navigate to the welcome interface
$("#back").on("click", function() {
  window.location = "welcome.php";
});


//retrieve and append food details to a table; realvent to each food id
function getFoodDetails(food_id, count) {

  $.ajax({
    url: "http://localhost/restaurant/dataAccess/foods.php?food_id=" + food_id,
    method: "GET",
    dataType: 'JSON',
    cache: false,
    success: function(row) {
      $('#food').append('<tr class="table-active" style="height: 30px">>');
      $('#food').append('<td  scope="row">' + row.food_name + '</td>');
      $('#food').append('<td class="price">' + row.price + '</td>');
      $('#food').append('<tr>');
      // get sum of food prices
      floatTotal = floatTotal + parseFloat(row.price);
      //append food ids to a paragraph tag with commas
      $('#foodh').append(row.food_id + ',');
      var intCount = parseInt(count);
      var intLen = parseInt(len - 1);
      // if count and the food array lenght is equals means array looped until last index. So get last sum value
      if (intCount === intLen) {
        //last sum is show as total price of food array
        $('#sum').append("Rs. " + floatTotal + ".00");
        //append for textbox inside the form to send total price to the database
        $('#price').append('<input type="number" name="total_price" id="price" hidden="hidden" value="' + floatTotal + '">');
      }
    },
    error: function(response) {}
  });
}


//send food deta to orders table
$('body').on("submit", function(event) {
  event.preventDefault();
  //take food ids from textbox with commans
  var textNames = $('.x p').text();
  //put id s to an array by removing commas
  var namesArr = textNames.split(',');

  //ajax call to post order data to the database
  $.ajax({
    url: "http://localhost/restaurant/dataAccess/orders.php",
    method: "POST",
    dataType: "JSON",
    data: $('#orderItems').serialize(),
    success: function(response) {
      swal({
        title: "Completed",
        text: "Order successfuly added!",
        type: "success"
      }).then(function() {
        window.location = "view_order.php";
      });
    }
  });


  //loop food ids
  for (var i = 0; i < len; i++) {
    //food id assign to a variable
    var current_food_id = namesArr[i];
    //append food id to a text box in the form
    $('#foodx').val(current_food_id);
    sendFoodData(); //call sendFoods function
  }
});


//function for send food data to the order_foods table
function sendFoodData() {
  $.ajax({
    url: "http://localhost/restaurant/dataAccess/order_foods.php",
    method: "POST",
    dataType: "JSON",
    data: $('#orderItems').serialize(),
    success: function(response) {}
  });
}
    </script>
  </body>
</html>
