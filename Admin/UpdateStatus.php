<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$flat_id = $object['flat_id'];
$status = $object['status'];
$data = mysqli_query($conn, "update `flats` set `status`='$status' where `flat_id`='$flat_id'");
if ($data) {
    $msg = array('data' => 'Uppdated!', 'status' => 'true');
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Failed!', 'status' => 'false');
    echo json_encode($msg);
}
