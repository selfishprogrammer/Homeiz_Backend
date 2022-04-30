<?php
$conn = mysqli_connect("localhost", "root", "", "homiz");
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);

$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$query_title = $object['query_title'];
$query = $object['query'];
$images = $object['images'];

$add_data = mysqli_query($conn, "insert into `contact_us` (`name`,`email`,`phone`,`query_title`,`query`,`image`) values ('$name','$email','$phone','$query_title','$query','$images')");
if ($add_data) {
    $msg = array('data' => 'We Have Recived Your Query . We Will Look Into It As Soon As Possible !', 'status' => 'true');
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Something went wrong !', 'status' => 'false');
    echo json_encode($msg);
}
