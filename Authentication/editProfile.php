<?php
require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$name = $object['name'];
$phone = $object['phone'];
$previous_email = $object['previous_email'];
if ($email != $previous_email) {
    $same_email = mysqli_query($conn, "select * from `users` where `email`='$email'");
    $nums_of_record = mysqli_num_rows($same_email);
    if ($nums_of_record > 0) {
        $msg = array('data' => 'Your New Email Cannot Be Same As Your Old Email', 'status' => 'false');
        echo json_encode($msg);
    } else {
        $update_profile = mysqli_query($conn, "update `users` set `name`='$name',`email`='$email',`phone`='$phone' where `email`='$previous_email'");
        if ($update_profile) {
            $fetch_data = mysqli_query($conn, "select * from `users` where `email`='$email'");
            $row = mysqli_fetch_assoc($fetch_data);
            $msg = array('data' => 'Your Profile Is Successfully Reset !', 'status' => 'true', 'name' => $row['name'], 'email' => $row['email'], 'phone' => $row['phone']);
            echo json_encode($msg);
        } else {
            $msg = array('data' => 'Something went wrong !', 'status' => 'false');
            echo json_encode($msg);
        }
    }
} else {
    $update_profile = mysqli_query($conn, "update `users` set `name`='$name',`email`='$email',`phone`='$phone' where `email`='$previous_email'");
    if ($update_profile) {
        $fetch_data = mysqli_query($conn, "select * from `users` where `email`='$email'");
        $row = mysqli_fetch_assoc($fetch_data);
        $msg = array('data' => 'Your Profile Is Successfully Reset !', 'status' => 'true', 'name' => $row['name'], 'email' => $row['email'], 'phone' => $row['phone']);
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something went wrong !', 'status' => 'false');
        echo json_encode($msg);
    }
}
