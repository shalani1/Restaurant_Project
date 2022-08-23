<!--Navigation bar-->
<nav class="navbar navbar-expand-sm navbar-dark bg-primary">
  <div class="container-fluid">
   <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <?php
          //If role of the login user is Admin, then only this items display in the navigation bar
          if ($_SESSION["role"] == "Admin") {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="welcomeAdmin.php">
              <img src="../assets/img/site_icon.png"; style="width: 40px; height: 40px;">
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" href="welcomeAdmin.php">Home
                <span class="visually-hidden">(current)</span>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="food_datatable.php">Foods</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="order_datatable.php">Orders</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="user_accounts.php">User Accounts</a>
            </li>
            ';
          } 
          //If role of the login user is Waiter, then only this items display in the navigation bar
          else {
            echo '
            <li class="nav-item">
              <a class="nav-link" href="welcome.php"><img src="assets/img/site_icon.png"; style="width: 40px; height: 40px;"></a>
            </li>

            <li class="nav-item">
              <a class="nav-link active" href="welcome.php">Home
            <span class="visually-hidden">(current)</span></a>
            </li>';
          }
        ?>     
      </ul>
      <div class="d-flex">
        <ul class="navbar-nav me-auto">
          <h1 hidden=""><?php echo htmlspecialchars($_SESSION["user_id"]); ?></h1>
          <h1 hidden=""><?php echo htmlspecialchars($_SESSION["role"]); ?></h1>
          <p class="nav-link" style="color: white;"><?php echo htmlspecialchars($_SESSION["name"]); ?></p>
            <?php
             //If role of the login user is Admin, then file path must change as below
              if ($_SESSION["role"] == "Admin") {
                echo '
                  <a class="nav-link" href="../session/reset-password.php">Password Reset</a>
                  <a class="nav-link" href="../session/logout.php">Logout</a>';
              } 
              //If role of the login user is Waiter, then file path must change as below
              else {
                echo '
                  <a class="nav-link" href="session/reset-password.php">Password Reset</a>
                  <a class="nav-link" href="session/logout.php">Logout</a>';
              }
            ?>
        </ul>       
      </div>
    </div>
  </div>
</nav>

