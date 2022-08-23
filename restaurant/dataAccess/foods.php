<?php
//include connection
require "../dbConnect/config.php";


if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //get specific food details according to the food id
    if (isset($_GET['food_id'])) {
        $sql = "SELECT * FROM foods WHERE food_id=" . $_GET['food_id'];
        $result = $conn->query($sql);
        header("HTTP/1.1 200 OK");
        echo json_encode($result->fetch_assoc());
    } else {
        //get details of all foods available in the database
        $sql = "SELECT * FROM foods";
        $result = $conn->query($sql);
        $records = [];
        while ($i = $result->fetch_assoc()) {
            $records[] = $i;
        }
        header("HTTP/1.1 200 OK");
        echo json_encode($records);
    }
}

//insert food details in to the database
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $food_name = $_POST['food_name'];
    $price = $_POST['price'];
    $user_id = $_POST['user_id'];
    $sql = "INSERT INTO foods (food_name,price,user_id) VALUES ('$food_name','$price','$user_id')";
    if ($conn->query($sql)) {
        header("HTTP/1.1 200 OK");
        echo json_encode(array('message' => 'success',));
    } else {
        header("HTTP/1.1 403 ERROR");
        echo json_encode(array('message' => 'error',));
    }
}

//update specific food details 
if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    if (isset($_GET['food_id'])) {
        $food_name = $_GET['food_name'];
        $price = $_GET['price'];
        $user_id = $_GET['user_id'];
        $sql = "UPDATE foods SET food_name='$food_name',price='$price',user_id='$user_id' WHERE food_id=" . $_GET['food_id'];
        if ($conn->query($sql)) {
            header("HTTP/1.1 200 SUCCESS");
            echo json_encode(array('message' => 'success'));
        } else {
            header("HTTP/1.1 403 ERROR");
            echo json_encode(array('message' => 'error'));
        }
    }
}

//delete specific food details
if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    if (isset($_GET['food_id'])) {
        $food_id = $_GET['food_id'];
        $sql = "DELETE FROM foods WHERE food_id='$food_id'";
        if ($conn->query($sql)) {
            header("HTTP/1.1 200 OK");
            echo json_encode(array('message' => 'success'));
        } else {
            header("HTTP/1.1 403 ERROR");
            echo json_encode(array('message' => 'error'));
        }
    }
}
?>