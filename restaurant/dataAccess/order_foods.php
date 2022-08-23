<?php
//include database connection
require "../dbConnect/config.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //get specific details from order_foods table
    if (isset($_GET['code'])) {
        $sql = 'SELECT * FROM order_foods where code=' . $_GET['code'];
        $result = $conn->query($sql);
        $records = array();
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    } else {
        //get all details from order_foods table
        $sql = 'SELECT * FROM order_foods';
        $result = $conn->query($sql);
        $records = array();
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
    header("HTTP/1.1 200 OK");
    echo json_encode($records);
}

//insert data to the order_foods table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $food_id = $_POST['food_id'];
    $sql = "INSERT INTO order_foods (code,food_id) VALUES ('$code','$food_id')";
    if ($conn->query($sql) === TRUE) {
        header("HTTP/1.1 200 OK");
        echo json_encode(array('message' => 'Success'));
    } else {
        header("HTTP/1.1 200 ERROR");
        echo json_encode(array('message' => 'Error'));
    }
}

//updatedetails of order_foods table
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $code = $_GET['code'];
        $food_id = $_GET['food_id'];
        $sql = "UPDATE order_foods SET id='$id',code='$code',food_id='$food_id' WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            header("HTTP/1.1 200 OK");
            echo json_encode(array('message' => 'Success'));
        } else {
            header("HTTP/1.1 200 ERROR");
            echo json_encode(array('message' => 'Error'));
        }
    }
}

//delete specific details from order_foods table
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM order_foods where id='$id'";
        if ($conn->query($sql) === TRUE) {
            header("HTTP/1.1 200 OK");
            echo json_encode(array('message' => 'Success'));
        } else {
            header("HTTP/1.1 200 ERROR");
            echo json_encode(array('message' => 'Error'));
        }
    }
}
?>