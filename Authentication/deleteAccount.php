
<?php
require_once('db.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$deleted = 'deleted';

$verify_email = mysqli_query($conn, "select * from `users` where `email`='$email'");
$nums_of_record = mysqli_num_rows($verify_email);
$row = mysqli_fetch_assoc($verify_email);
if ($nums_of_record > 0) {
    $delete_Account = mysqli_query($conn, "update `users` set `account_status`='$deleted' where `email`='$email'");
    if ($delete_Account) {
        $msg = array('data' => 'Your Account is Deleted SuccessFully! Sorry To See You Leaving Us', 'status' => 'true');
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Failed To Delete! Check Back Later', 'status' => 'false');
        echo json_encode($msg);
    }
} else {
    $msg = array('data' => 'Email Not Registered !', 'status' => 'false');
    echo json_encode($msg);
}
