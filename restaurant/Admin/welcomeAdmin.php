<?php
// Initialize the session
session_start(); 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Welcome Admin</title>
        <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
        <?php require "../nav.php"; ?>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="../assets/img/admin.jpg" ; style="margin-top: 100px" />
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <h3 class="text-info" style="margin-top: 180px"><?php echo htmlspecialchars($_SESSION["name"]); ?></h3>
                    <h3 style="margin-top: 50px">Welcome!</h3>
                </div>
            </div>
        </div>
    </body>
</html>
