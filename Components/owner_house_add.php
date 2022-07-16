<?php
require_once("../Authentication/db.php");
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$flat_name = $object['flat_name'];
$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$owner_id = $object['user_id'];
$address = $object['address'];
$latitude = $object['latitude'];
$longitude = $object['longitude'];
$latitude_for_map = $object['latitude_for_map'];
$longitude_for_map = $object['longitude_for_map'];
$pin_code = $object['pin_code'];
$parking = $object['parking'];
$type = $object['type'];
$bathroom = $object['bathroom'];
$furnishing = $object['furnishing'];
$listed_by = $object['listed_by'];
$bhk = $object['bhk'];
$sqft = $object['sqft'];
$bachlor = $object['bachlor'];
$total_floors = $object['total_floors'];
$house_details = $object['house_details'];
$state = $object['state'];
$district = $object['district'];
$your_price = $object['your_price'];
$recommend_price = $object['recommend_price'];
$real_price = $object['real_price'];
$image_1 = $object['image_1'];
$image_2 = $object['image_2'];
$image_3 = $object['image_3'];
$image_4 = $object['image_4'];
$status = $object['status'];
$add_owner = mysqli_query($conn, "insert into `flats` (`flat_name`,`owner_name`,`owner_id`,`owner_email`,`owner_phone`,`home_address`,`latitude`,`longitude`,`latitude_for_map`,`longitude_for_map`,`pin_code`,`parking`,`type`,`bathroom`,`furnishing`,`listed_by`,`bhk`,`sqft`,`bachlor`,`total_floors`,`house_details`,`state`,`district`,`your_price`,`recommend_price`,`real_price`,`image_1`,`image_2`,`image_3`,`image_4`,`status`) values ('$flat_name','$name','$owner_id','$email','$phone','$address','$latitude','$longitude','$latitude_for_map','$longitude_for_map','$pin_code','$parking','$type','$bathroom','$furnishing','$listed_by','$bhk','$sqft','$bachlor','$total_floors','$house_details','$state','$district','$your_price','$recommend_price','$real_price','$image_1','$image_2','$image_3','$image_4','$status')");
if ($add_owner) {
    $msg = array('data' => 'House Added Successfully !', 'status' => 'true',);
    echo json_encode($msg);
} else {
    $msg = array('data' => 'Something Went Wrong !', 'status' => 'false',);
    echo json_encode($msg);
}
