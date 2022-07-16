<?php
require_once('../Authentication/db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$user_id = $object['user_id'];
$categories = $object['categories'];
$data = mysqli_query($conn, "update `users` set `categories`='$categories' where `user_id`='$user_id'");
if ($data) {
    $msg = array('data' => 'Uppdated!', 'status' => 'true');
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Failed!', 'status' => 'false');
    echo json_encode($msg);
}
