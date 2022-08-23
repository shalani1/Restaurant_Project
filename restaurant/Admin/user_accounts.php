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
    <title>Accounts</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <?php require "../nav.php"; ?>
  </head>
  <body>
    <div class="container mt-5">
      <h2>User Accounts</h2>
      <div class="row mt-5">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#" rel="addUser">Add User</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#" rel="update_delete">Update/Delete User</a>
          </li>
        </ul>
        <!--form for create new user account-->
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade active show" id="addUser">
            <div class="col-md-5 mt-5">
              <form id="addUsers">
                <fieldset>
                  <legend>Add User</legend>
                  <div class="form-group">
                    <label for="name" class="form-label mt-2">Name</label>
                    <input type="text" class="form-control" name="name" id="name" required="" />
                  </div>
                  <div class="form-group">
                    <label for="role" class="form-label mt-2">Role</label>
                    <select class="form-select" id="role_selected" name="role">
                      <option value="Waiter">Waiter</option>
                      <option value="Admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="username" class="form-label mt-2">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required="" />
                  </div>
                  <div class="form-group">
                    <label for="password" class="form-label mt-2">Password</label>
                    <input type="text" class="form-control" name="password" id="password" required="" />
                  </div>
                  <button type="submit" class="btn btn-primary mt-3" id="add">Add</button>
                  <a href="user_accounts.php"><button type="button" class="btn btn-primary mt-3">Cancel</button></a>
                </fieldset>
              </form>
            </div>
          </div>
          <!--update user account details-->
          <div class="tab-pane fade active show" id="update_delete" style="display: none;">
            <div class="col-md-5 mt-5">
              <form id="updateUsers" style="display: none;">
                <fieldset>
                  <legend>Update User</legend>
                  <input type="Number" name="user_id" hidden="hidden" id="user_id" />
                  <div class="form-group">
                    <label for="name" class="form-label mt-2">Name</label>
                    <p id="names"></p>
                  </div>
                  <div class="form-group">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select" id="role_selected2" name="role">
                      <option value="Waiter">Waiter</option>
                      <option value="Admin">Admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="username" class="form-label mt-2">Username</label>
                    <p id="usernames"></p>
                  </div>
                  <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <p id="passwords"></p>
                  </div>
                  <input type="submit" class="btn btn-primary" name="update" id="update" value="Update" />
                  <a href="user_accounts.php"><button type="button" class="btn btn-primary">Cancel</button></a>
                </fieldset>
              </form>
            </div>
            <!--display user details-->
            <input type="text" name="" hidden="hidden" id="id" />
            <table class="table table-hover" id="user_details">
              <thead>
                <tr>
                  <th scope="col">User Id</th>
                  <th scope="col">Name</th>
                  <th scope="col">Role</th>
                  <th scope="col">Username</th>
                  <th scope="col">Password</th>
                  <th scope="col">Created Date</th>
                </tr>
              </thead>
              <tbody id="users">
                <!--useer details load here-->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <br />
    <br />
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/sweetalert.min.js"></script>
    <script src="../assets/js/user_accounts.js"></script>
  </body>
</html>
