<?php
//include database connection
require "../dbConnect/config.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['order_id'])) {
        //get specific order details from orders table
        $sql = 'SELECT * FROM orders where order_id=' . $_GET['order_id'];
        $result = $conn->query($sql);
        $records = $result->fetch_assoc();
    } else {
        //get all orders details from orders table
        $sql = 'SELECT * FROM orders';
        $result = $conn->query($sql);
        $records = array();
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
    header("HTTP/1.1 200 OK");
    echo json_encode($records);
}

//insert order details to the orders table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $total_price = $_POST['total_price'];
    $user_id = $_POST['user_id'];
    $code = $_POST['code'];
    $sql = "INSERT INTO orders (code,total_price,user_id) VALUES ('$code','$total_price','$user_id')";
    if ($conn->query($sql) === TRUE) {
        header("HTTP/1.1 200 OK");
        echo json_encode(array('message' => 'Success'));
    } else {
        header("HTTP/1.1 200 ERROR");
        echo json_encode(array('message' => 'Error'));
    }
}

//update specific order details in the orders table
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $code = $_GET['code'];
        $food_id = $_GET['food_id'];
        $total_price = $_GET['total_price'];
        $user_id = $_GET['user_id'];
        $sql = "UPDATE orders SET code='$code',food_id='$food_id', total_price='$total_price',user_id='$user_id' WHERE order_id='$order_id'";
        if ($conn->query($sql) === TRUE) {
            header("HTTP/1.1 200 OK");
            echo json_encode(array('message' => 'Success'));
        } else {
            header("HTTP/1.1 200 ERROR");
            echo json_encode(array('message' => 'Error'));
        }
    }
}

//delete specific order details from orders table
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $sql = "DELETE FROM orders where order_id='$order_id'";
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