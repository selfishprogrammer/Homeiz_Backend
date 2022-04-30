<?php
require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$password = $object['password'];

$same_pass = mysqli_query($conn, "select * from `users` where `email`='$email' and `password`='$password'");
$nums_of_record = mysqli_num_rows($same_pass);
if ($nums_of_record > 0) {
    $msg = array('data' => 'Your New Password Cannot Be Same As Your Old Password', 'status' => 'false');
    echo json_encode($msg);
} else {
    $update_pass = mysqli_query($conn, "update `users` set `password`='$password' where `email`='$email'");
    if ($update_pass) {
        $same_pass1 = mysqli_query($conn, "select * from `users` where `email`='$email'");
        $row = mysqli_fetch_assoc($same_pass1);
        $msg = array('data' => 'Your Password Is Successfully Reset !', 'status' => 'true', 'name' => $row['name'], 'email' => $row['email'], 'phone' => $row['phone']);
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something went wrong !', 'status' => 'false');
        echo json_encode($msg);
    }
}
