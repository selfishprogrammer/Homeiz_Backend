<?php
$conn = mysqli_connect("localhost", "root", "", "homiz");
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$password = $object['password'];
$categories = $object['categories'];

$duplicate_email = mysqli_query($conn, "select * from `users` where `email`='$email' and `account_status`=''");
$nums_of_record = mysqli_num_rows($duplicate_email);
$account_status = mysqli_query($conn, "select * from `users` where `email`='$email' and `account_status`='deleted'");
$nums_of_records = mysqli_num_rows($account_status);
if ($nums_of_record > 0) {
    $msg = array('data' => 'Email Already Exists', 'status' => 'false');
    echo json_encode($msg);
}
if ($nums_of_records > 0) {
    $update_data = mysqli_query($conn, "update `users` set `name`='$name', `email`='$email',`phone`='$phone',`password`='$password',`otpValue`='', `emailVerified`='[ ]' , `account_status`='' , `categories`='$categories' where `email`='$email'");
    if ($update_data) {
        $msg = array('data' => 'Successfully Registered !', 'status' => 'true');
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something Went Wrong !', 'status' => 'false');
        echo json_encode($msg);
    }
} else {
    $insert_data = mysqli_query($conn, "insert into `users` (`name`,`email`,`phone`,`password`,`otpValue`,`emailVerified`,`categories`,`account_status`) values ('$name','$email','$phone','$password','','[ ]','$categories','')");
    if ($insert_data) {
        $msg = array('data' => 'Successfully Registered !', 'status' => 'true');
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something Went Wrong !', 'status' => 'false');
        echo json_encode($msg);
    }
}
