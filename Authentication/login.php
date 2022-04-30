<?php
require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$password = $object['password'];

$check_login = mysqli_query($conn, "select * from `users` where `email`='$email' and `account_status`=''");
$nums_of_record = mysqli_num_rows($check_login);

if ($nums_of_record > 0) {
    $row = mysqli_fetch_assoc($check_login);
    $msg = array('data' => 'Successfully LoggedIn !', 'status' => 'true', 'name' => $row['name'], 'email' => $row['email'], 'phone' => $row['phone'], 'password' => $row['password'], 'categories' => $row['categories']);
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Email Or Password Incorrect!', 'status' => 'false');
    echo json_encode($msg);
}
