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
    <title>Foods</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <?php require "../nav.php"; ?>
  </head>
  <body>
    <div class="container mt-5">
      <h2>Foods</h2>
      <div class="row mt-5">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#" rel="addFood">Add Food</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#" rel="update_delete">Update/Delete Food</a>
          </li>
        </ul>
        <!--form for adding new foods-->
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active show" id="addFood">
            <div class="col-md-5 mt-5">
              <form id="addFoods">
                <fieldset>
                  <legend>Add Food</legend>
                  <input type="Number" name="user_id" hidden="hidden" id="user_id" value='<?php echo htmlspecialchars($_SESSION["user_id"]); ?>' />
                  <div class="form-group">
                    <label for="foodName" class="form-label mt-2">Food Name</label>
                    <input type="text" class="form-control" name="food_name" id="food_name" required="" />
                  </div>
                  <div class="form-group">
                    <label for="foodprice" class="form-label mt-2">Price</label>
                    <input type="number" class="form-control" name="price" id="price" required="" />
                  </div>
                  <button type="submit" class="btn btn-primary mt-3" id="add">Add</button>
                  <a href="food_datatable.php"><button type="button" class="btn btn-primary mt-3">Cancel</button></a>
                </fieldset>
              </form>
            </div>
          </div>
          <!--form for update added foods-->
          <div class="tab-pane fade active show" id="update_delete" style="display: none;">
            <div class="col-md-5 mt-5">
              <form id="updateFoods" style="display: none;">
                <fieldset>
                  <legend>Update Food</legend>
                  <input type="Number" name="user_id" hidden="hidden" id="user_id" value='<?php echo htmlspecialchars($_SESSION["user_id"]); ?>' />
                  <input type="number" hidden="hidden" name="food_id" id="food_id" />
                  <div class="form-group">
                    <label for="foodNames" class="form-label mt-2">Food Name</label>
                    <p id="foodname"></p>
                  </div>
                  <div class="form-group">
                    <label for="foodprice" class="form-label mt-2">Price</label>
                    <p id="foodprices"></p>
                  </div>
                  <input type="submit" class="btn btn-primary" name="submit" id="update" value="Update" />
                  <a href="food_datatable.php"><button type="button" class="btn btn-primary">Cancel</button></a>
                </fieldset>
              </form>
            </div>
            <!--view food details-->
            <input type="text" name="" hidden="hidden" id="id" />
            <table class="table table-hover mt-5" id="items">
              <thead>
                <tr>
                  <th scope="col">Food Item</th>
                  <th scope="col">Price</th>
                  <th scope="col">Added By</th>
                </tr>
              </thead>
              <tbody id="food">
                <!--food details load here-->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/food_datatable.js"></script>
  </body>
</html>
