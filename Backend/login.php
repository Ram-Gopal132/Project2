<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMIP;

require 'db.php';
require 'vender/autoload.php';

session_start();

// request from client with email address
if($_SERVER['REQUST_METHOD']=='POST' && isset($_POST['email'])){
$email=$conn->real_escape_string($_POST['email'])
$result=$conn->query("select * from user where email='$email';");
if($result->num_rows){
    $_SESSION['EMAIL']=$email;
    $otp=read(1111,9999);
    $conn->query("update user set otp=$otp where email='$email';");
    sendEmail($email,$otp);
    echo json_encode(['status'=>'success'])
}
else
echo json_encode(['status' => 'failure']);
exit();
}
// request from client with otp code
if($_SERVER['REQUST_METHOD']=='POST' && isset($_POST['otp'])){
    $userprovidedotp=$conn->real_escape_string($_POST['otp'])
    $email=$_SESSION['EMAIL']
    $result=$conn->query("select * from user where otp=$userprovided and email=$email ")
    if($result->num_row){
        $_SESSION['LOGGEDIN']=true;
        echo json_encode(['status'=>'success']);

    }
    else
    echo json_encode(['status'=>'failure']);
exit();
}
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_SESSION['LOGGEDIN']))
    echo json_encode(['status'=>'success']);
    else
    echo json_encode(['status'=>'failure']);
    exit();
}

if($_SERVER['REQUEST_METHOD']=='GET' && isset($GET['logout'])){
    unset($_SESSION['EMAIL']);
    unset($_SESSION['LOGGDIN']);
    session_destroy();
    echo json_encode(['status'=>'success']);
    
    exit();
}

// functionsend email logic
function sendEmail($email,$otp){
$email=new PHPMailer(true);
try{
    
    $mail->isSTMP();
    $mail->HOST='smtp.gmail.com';
    $mail->USERNAME'ramgopalgupta053@gmail.com'
    $mail->PASSWORD'....';
    $mail->STMPAuth=true;
    $mail->port=587;
    $mail->SMTPSecure='tls';
    $mail->setFrom('ramgopalgupta053@gmail.com','resquare')
    $mail->addAddress($email)
    $mail->isHTML(true);
    $mail->Subject='your OTP Code';
    $mail->Body='Here is your OTP code: <br> $otp';
    $mail->send();


}catch(Exception)

}




