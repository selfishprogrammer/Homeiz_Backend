<?php

require_once('db.php');
require_once('smtp/PHPMailerAutoload.php');
header('Access-Control-Allow-Origin: *');
$json = file_get_contents("php://input");
$object = json_decode($json, true);
$email = $object['email'];
$otp = sprintf("%06d", mt_rand(1, 999999));
$to = $email;
$subject = "Homiez OTP Verification";
$msg = 'Your One Time Password Verification Code is::';
$msg1 = '</br>';
$msg4 = '</br>';
$msg2 = "<b>" . $otp . "</b>";
$msg3 = 'Do not share with anyone..........';
$template = $msg . '<br><br>' . $msg2 . '<br><br>' . $msg3;

function smtp_mailer($to, $subject, $template)
{
    $mail = new PHPMailer();
    $mail->SMTPDebug = 3;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'ssl';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "loknath2023@gmail.com";
    $mail->Password = 'LOKNATH DAS';
    $mail->SetFrom("loknath2023@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $template;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        echo 'Sent';
    }
}
$update_otp = mysqli_query($conn, "update `users` set `otpValue`='$otp' where `email`='$email'");
if ($update_otp) {

    $resp = array('data' => 'OTP Send Successfully to ', 'status' => 'true', 'OTP' => $otp);
    echo json_encode($resp);

    echo smtp_mailer($to, $subject, $template);
} else {
    $resp = array('data' => 'Failed To Send OTP', 'status' => 'false');
    echo json_encode($resp);
}
