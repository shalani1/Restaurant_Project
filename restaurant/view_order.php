<?php
//initialize session
 session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Current Order Summary</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <?php require "nav.php"; ?>
  </head>
  <body>
    <div class="container mt-5">
      <h2>Order Summary</h2>
      <div class="row">
        <table class="table table-hover mt-5" id="items">
          <thead>
            <tr>
              <th scope="col">Order Code</th>
              <th scope="col">Food Name</th>
              <th scope="col">Price</th>
            </tr>
          </thead>
          <tbody id="orders"></tbody>
        </table>
        <h4 class="mt-4" style="color: #375A7F;">Total Price: Rs. <span id="total"></span>.00</h4>
      </div>
      <a href="welcome.php"><button type="submit" name="" class="btn btn-primary mt-3">Finish</button></a>
    </div>
    <br />
    <br />
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/view_order.js"></script>
  </body>
</html>
