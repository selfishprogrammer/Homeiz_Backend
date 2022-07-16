<?php

require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$latitude = $object['latitude'];
$longitude = $object['longitude'];

$update_latlong = mysqli_query($conn, "update `users` set `latitude`='$latitude' , `longitude`='$longitude' where `email`='$email'");
if ($update_latlong) {
    $msg = array('data' => 'Location Retrived Successfully', 'status' => 'true');
    echo json_encode($msg);
} else {
    $msg = array('data' => 'failed to fetch location...', 'status' => 'false');
    echo json_encode($msg);
}
