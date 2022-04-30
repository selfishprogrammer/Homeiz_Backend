<?php
$conn = mysqli_connect("localhost", "root", "", "homiz");
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$flat_name = $object['flat_name'];
$name = $object['name'];
$email = $object['email'];
$phone = $object['phone'];
$owner_id = $object['user_id'];
$address = $object['address'];
$flat_id = $object['flat_id'];
$latitude = $object['latitude'];
$longitude = $object['longitude'];
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
$image_1 = $_FILES['image_1']['name'];
$image_2 = $_FILES['image_2']['name'];
$image_3 = $_FILES['image_3']['name'];
$image_4 = $_FILES['image_4']['name'];
$image_tmp_1 = $_FILES['image_1']['tmp_name'];
$image_tmp_2 = $_FILES['image_2']['tmp_name'];
$image_tmp_3 = $_FILES['image_3']['tmp_name'];
$image_tmp_4 = $_FILES['image_4']['tmp_name'];
$directory1 = "Images/" . $image_1;
move_uploaded_file($image_tmp_1, $directory1);
$directory2 = "Images/" . $image_2;
move_uploaded_file($image_tmp_2, $directory2);
$directory3 = "Images/" . $image_3;
move_uploaded_file($image_tmp_3, $directory3);
$directory4 = "Images/" . $image_4;
move_uploaded_file($image_tmp_4, $directory4);
$status = $object['status'];
$msg = "insert into `flats` (`flat_name`,`owner_name`,`owner_id`,`owner_name`,`owner_phone`,`home_address`,`latitude`,`longitude`,`pin_code`,`parking`,`type`,`bathroom`,`furnishing`,`listed_by`,`bhk`,`sqft`,`bachlor`,`total_floors`,`house_details`,`state`,`district`,`your_price`,`recommend_price`,`real_price`,`image_1`,`image_2`,`image_3`,`image_4`,`status`) values ('$flat_name','$name','$owner_id','$email','$phone','$address','$latitude','$longitude','$pin_code','$parking','$type','$bathroom','$furnishing','$listed_by','$bhk','$sqft','$bachlor','$total_floors','$house_details','$state','$district','$your_price','$recommend_price','$real_price','$image_1','$image_2','$image_3','$image_4','$status')";
echo $msg;
$add_owner = mysqli_query($conn, "insert into `flats` (`flat_name`,`owner_name`,`owner_id`,`owner_name`,`owner_phone`,`home_address`,`latitude`,`longitude`,`pin_code`,`parking`,`type`,`bathroom`,`furnishing`,`listed_by`,`bhk`,`sqft`,`bachlor`,`total_floors`,`house_details`,`state`,`district`,`your_price`,`recommend_price`,`real_price`,`image_1`,`image_2`,`image_3`,`image_4`,`status`) values ('$flat_name','$name','$owner_id','$email','$phone','$address','$latitude','$longitude','$pin_code','$parking','$type','$bathroom','$furnishing','$listed_by','$bhk','$sqft','$bachlor','$total_floors','$house_details','$state','$district','$your_price','$recommend_price','$real_price','$image_1','$image_2','$image_3','$image_4','$status')");
if ($add_owner) {
    if ($add_owner) {
        $msg = array('data' => 'House Added Successfully !', 'status' => 'true',);
        echo json_encode($msg);
    } else {
        $msg = array('data' => 'Something Went Wrong !', 'status' => 'false',);
        echo json_encode($msg);
    }
}



// "{"falt_name":"","name":"Rahul Jha","email":"admin@gmail.com","phone":"6296002855","user_id":1,"address":"","longitude":22.5,"latitude":22.8,"pin_code":"","parking":"","type":"","bathroom":"","furneshing":"","listed_by":"","bhk":"","sqft":"","bachlor":"","total_floors":"","house_details":"","image_1":{},"image_2":{},"image_3":{},"image_4":{},"status":"pending","state":"","district":"","your_price":"","recomaned_price":"","real_price":"2399"}"
// "{"falt_name":"qwer","name":"Rahul Jha","email":"admin@gmail.com","phone":"6296002855","user_id":1,"address":"sasnkdhsagdhsg csdsdds","longitude":22.5,"latitude":22.8,"pin_code":"123448","parking":"1","type":"Appartments","bathroom":"1","furneshing":"Fully Furnished","listed_by":"By Owner","bhk":"1BHK","sqft":"1234","bachlor":"","total_floors":"12","house_details":"jhdsfdghfd hdfbdhgvdfh fdhbgkdfhjghfg bfdhgdfjb","image_1":{},"image_2":{},"image_3":{},"image_4":{},"status":"pending","state":"Kolkata","district":"Bankura","your_price":"1234","recomaned_price":16776,"real_price":"2399"}"