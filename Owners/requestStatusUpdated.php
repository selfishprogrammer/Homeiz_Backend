<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);

$flat_id=$object['flat_id'];
$email=$object['email'];
$status=$object['status'];

$update_status=mysqli_query($conn,"update `contact_owners` set `status`='$status' where `flat_id`='$flat_id' and `email`='$email'");
if($update_status){
    $msg = array('data' => 'Updated Successfully !', 'status' => 'true',);
    echo json_encode($msg);
}else{
    $msg = array('data' => 'Something Went Wrong !', 'status' => 'false',);
    echo json_encode($msg);
}
