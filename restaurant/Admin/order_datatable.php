<?php
//Initialize session
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
    <title>Order Details</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <?php require "../nav.php"; ?>
  </head>
  <body>
    <!-- display order details-->
    <div class="container mt-5">
      <h2>Orders Details</h2>
      <div class="row">
        <table class="table table-hover mt-5" id="items">
          <thead>
            <tr>
              <th scope="col">Order Code</th>
              <th scope="col">Food Name</th>
              <th scope="col">Price</th>
              <th scope="col">Order Date</th>
              <th scope="col">Waiter</th>
            </tr>
          </thead>
          <tbody id="orders">
            <!--orders details load here-->
          </tbody>
        </table>
      </div>
    </div>
    <br />
    <br />
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/order_datatable.js"></script>
  </body>
</html>
