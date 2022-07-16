<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$data = mysqli_query($conn, "select * from `flats` where `owner_email`='$email'");
$nums_of_record = mysqli_num_rows($data);

if ($nums_of_record > 0) {
    $row = mysqli_fetch_all($data, MYSQLI_ASSOC);
    echo json_encode($row);
} else {
    $msg = array('data' => 'Failed!', 'status' => 'false');
    echo json_encode($msg);
}
