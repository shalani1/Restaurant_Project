<?php
require "../dbConnect/config.php";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    //get details of specific user from users table
    if (isset($_GET['user_id'])) {
        $sql = 'SELECT * FROM users where user_id=' . $_GET['user_id'];
        $result = $conn->query($sql);
        $records = $result->fetch_assoc();
    } else {
        //get details of all users in the users table
        $sql = 'SELECT * FROM users';
        $result = $conn->query($sql);
        $records = array();
        while ($row = $result->fetch_assoc()) {
            $records[] = $row;
        }
    }
    header("HTTP/1.1 200 OK");
    echo json_encode($records);
}

//intert new user details to the users table
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $p_password = $password;
    $sql = "INSERT INTO users (name,role,username,password) VALUES ('$name','$role','$username','$p_password')";
    if ($conn->query($sql) === TRUE) {
        header("HTTP/1.1 200 OK");
        echo json_encode(array('message' => 'Success'));
    } else {
        header("HTTP/1.1 200 ERROR");
        echo json_encode(array('message' => 'Error'));
    }
}

//update specific user details in the users table
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (isset($_GET['user_id'])) {
        $name = $_GET['name'];
        $user_id = $_GET['user_id'];
        $role = $_GET['role'];
        $username = $_GET['username'];
        $password = $_GET['password'];
        $p_password = $password;
        $sql = "UPDATE users SET name='$name',role='$role',username='$username',password='$p_password' WHERE user_id='$user_id'";
        if ($conn->query($sql) === TRUE) {
            header("HTTP/1.1 200 OK");
            echo json_encode(array('message' => 'Success'));
        } else {
            header("HTTP/1.1 200 ERROR");
            echo json_encode(array('message' => 'Error'));
        }
    }
}

//delete specific user from the users table
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $sql = "DELETE FROM users where user_id='$user_id'";
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