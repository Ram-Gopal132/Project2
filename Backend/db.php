<?php
$conn= new mysqli("localhost:3306",'root','root','otp_login');
if($conn->connect_errno){
    echo jsom_encode(['status' => $conn->connect_error]);
    exit();
}