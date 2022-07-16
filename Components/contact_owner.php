<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);

$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$address = $object['address'];
$flat_id = $object['flat_id'];
$owner_email = $object['owner_email'];
$flat_details = $object['flat_details'];
$home_address = $object['home_address'];
$zip_code = $object['zip_code'];
$flat_name = $object['flat_name'];
$fetch_record = mysqli_query($conn, "select * from `contact_owners` where `flat_id`='$flat_id' and `email`='$email'");
$nums = mysqli_num_rows($fetch_record);
$row = mysqli_fetch_assoc($fetch_record);

if ($nums == null) {
    $add_record = mysqli_query($conn, "insert into `contact_owners` (`name`,`email`,`phone`,`address`,`flat_id`,`flat_owner_email`,`status`,`flat_name`,`flat_details`,`flat_address`,`zip`) values ('$name','$email','$phone','$address','$flat_id','$owner_email','pending','$flat_name','$flat_details','$home_address','$zip_code')");

    if ($add_record) {
        $fetch_record2 = mysqli_query($conn, "select `status` from `contact_owners` where `flat_id`='$flat_id' and `email`='$email'");
        $nums = mysqli_num_rows($fetch_record2);
        $row = mysqli_fetch_assoc($fetch_record2);
        $msg = array('data' => 'Details Sent Successfully ! Wait Pleasently Owner Will Contact You Soon', 'status' => 'true', 'state' => $row['status']);
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something Went Wrong !', 'status' => 'false',);
        echo json_encode($msg);
    }
} else {
    if ($row['status'] == 'Approved') {
        $msg = array('data' => 'Owners Has Approved Your Request Now You Can Contact to Owners ', 'status' => 'false', 'state' => $row['status']);
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'You Have Already Submitted The Respone ! Owners Will Approve Your Request Soon', 'status' => 'false', 'state' => $row['status']);
        echo json_encode($msg);
    }
}
