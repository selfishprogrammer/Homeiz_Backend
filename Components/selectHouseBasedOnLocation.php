<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$search_based_on = $object['search_based_on'];
$latitude = $object['latitude'];
$longitude = $object['longitude'];
$state = $object['state'];
$district = $object['district'];

if ($search_based_on == 'location') {
    $data_location = mysqli_query($conn, "select * from `flats` where `latitude`='$latitude' and `longitude`='$longitude'");
    $nums_of_record = mysqli_num_rows($data_location);

    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($data_location, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($search_based_on == 'address') {
    $data_by_address = mysqli_query($conn, "select * from `flats` where `state`='$state' and `district`='$district'");
    $nums_of_record = mysqli_num_rows($data_by_address);

    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($data_by_address, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($search_based_on == '') {
    $data = mysqli_query($conn, "select * from `flats`");
    $nums_of_record = mysqli_num_rows($data);

    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
}
