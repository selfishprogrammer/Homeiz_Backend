<?php
require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];

$verify_email = mysqli_query($conn, "select * from `users` where `email`='$email' and `account_status`=''");
$nums_of_record = mysqli_num_rows($verify_email);
$row = mysqli_fetch_assoc($verify_email);
if ($nums_of_record > 0) {
    $msg = array('data' => 'Verified !', 'status' => 'true');
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Email Not Registered !', 'status' => 'false');
    echo json_encode($msg);
}
