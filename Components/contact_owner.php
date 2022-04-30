<?php
$conn = mysqli_connect("localhost", "root", "", "homiz");
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);

$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$address = $object['address'];
$flat_id = $object['flat_id'];

$add_record = mysqli_query($conn, "insert into `contact_owners` (`name`,`email`,`phone`,`address`,`flat_id`) values ('$name','$email','$phone','$address','$flat_id')");

if ($add_record) {

    $msg = array('data' => 'Details Sent Successfully ! Wait Pleasently Owner Will Contact You Soon', 'status' => 'true',);
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Something Went Wrong !', 'status' => 'false',);
    echo json_encode($msg);
}
