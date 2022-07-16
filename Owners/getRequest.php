<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);

$email = $object['owner_email'];
$status = $object['status'];
if ($status == "") {
    $house_request_all = mysqli_query($conn, "select * from `contact_owners` where `flat_owner_email` ='$email'");
    // echo $house_request_all;
    $nums_of_record = mysqli_num_rows($house_request_all);
    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($house_request_all, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($status == 'pending') {
    $house_request_pending = mysqli_query($conn, "select * from `contact_owners` where `flat_owner_email` ='$email' and `status`='$status'");
    // echo $house_request_pending;
    $nums_of_record = mysqli_num_rows($house_request_pending);
    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($house_request_pending, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($status == 'completed') {
    $house_request_pending = mysqli_query($conn, "select * from `contact_owners` where `flat_owner_email` ='$email' and `status`='$status'");
    // echo $house_request_pending;
    $nums_of_record = mysqli_num_rows($house_request_pending);
    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($house_request_pending, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($status == 'approved') {
    $house_request_pending = mysqli_query($conn, "select * from `contact_owners` where `flat_owner_email` ='$email' and `status`='$status'");
    // echo $house_request_pending;
    $nums_of_record = mysqli_num_rows($house_request_pending);
    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($house_request_pending, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($status == 'rejected') {
    $house_request_pending = mysqli_query($conn, "select * from `contact_owners` where `flat_owner_email` ='$email' and `status`='$status'");
    // echo $house_request_pending;
    $nums_of_record = mysqli_num_rows($house_request_pending);
    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($house_request_pending, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
} else if ($status == 'date') {
    $house_request_pending = mysqli_query($conn, "select * from `contact_owners` order by `date_of_request`");
    // echo $house_request_pending;
    $nums_of_record = mysqli_num_rows($house_request_pending);
    if ($nums_of_record > 0) {
        $row = mysqli_fetch_all($house_request_pending, MYSQLI_ASSOC);
        echo json_encode($row);
    } else {
        $msg = array('data' => 'Failed!', 'status' => 'false');
        echo json_encode($msg);
    }
}
