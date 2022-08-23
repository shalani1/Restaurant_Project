<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Foods</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <?php require "nav.php"; ?>
  </head>
  <body>
    <div class="container mt-5">
      <h2>Menu</h2>
      <div class="row mt-5">
        <form action="order_details.php" method="POST">
          <table class="table table-hover" id="items">
            <thead>
              <tr>
                <th scope="col">Food Item</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody id="food">
              <!--load food details here-->
            </tbody>
          </table>
          <fieldset>
            <input type="submit" name="button" id="button" value="Order" class="btn btn-primary" />
            <input type="Reset" value="Reset" class="btn btn-primary" />
          </fieldset>
        </form>
      </div>
    </div>
    <br />
    <br />
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/menu.js"></script>
  </body>
</html>
