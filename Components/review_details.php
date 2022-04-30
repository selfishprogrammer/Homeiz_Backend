<?php
$conn = mysqli_connect("localhost", "root", "", "homiz");
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);

$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$update_record = mysqli_query($conn, "update `users` set `name`='$name' , `phone`='$phone' where `email`='$email'");

if ($update_record) {

    $msg = array('data' => 'Details Updated Successfully !', 'status' => 'true',);
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Something Went Wrong !', 'status' => 'false',);
    echo json_encode($msg);
}
