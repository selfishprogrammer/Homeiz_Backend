<?php
require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$otp = $object['otp'];

$verifyOtp = mysqli_query($conn, "select * from `users` where `email`='$email' and `otpValue`='$otp'");
$nums = mysqli_num_rows($verifyOtp);
if ($nums > 0) {
    $update_email_verification = mysqli_query($conn, "update `users` set `emailVerified`='[v]' where `email`='$email'");
    if ($update_email_verification) {
        $msg = array('data' => 'OTP successfully Verified !', 'status' => 'true');
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something Went Wrong !', 'status' => 'false');
        echo json_encode($msg);
    }
} else {
    $msg = array('data' => 'OTP Verification Failed !', 'status' => 'false');
    echo json_encode($msg);
}
