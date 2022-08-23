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
        <title>Welcome User</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <!--include navigation bar-->
        <?php require "nav.php"; ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <!--welcome interface image-->
                    <img src="assets/img/menu.jpg" ; />
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <h3 style="margin-top: 100px">Welcome!</h3>
                    <a href="menu.php">
                        <button type="button" class="btn btn-primary btn-lg" href="menu.php" style="margin-top: 100px">Place New Order</button>
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
