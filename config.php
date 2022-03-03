<?php
error_reporting(0);
session_start();
$CONGIG = [ 
  "host_name"  => 'localhost',
  "username"  => 'lequocda_die575',
  "password"  => 'lequocda_die575',
  "database"  => 'lequocda_die575',
];
$star = (object) $CONGIG;
$kunloc = new mysqli($star->host_name, $star->username, $star->password, $star->database);
$kunloc->set_charset('UTF8');
if ($kunloc->connect_error) die('Error : ('. $kunloc->connect_errno .') '. $kunloc->connect_error); 
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* CẤU HÌNH EMAIL CONFIRM */
$emailer = "lequocdat206@gmail.com";
$passmailer = "";
/* Setup Thesieure.com */
$THESIEURE = [
 "loai"=>"The Sieu Re",
 "stk"=>"null",
 "name"=>"null",
 "chinhanh"=>"null",
 "username" => "null",
 "password" => "",
 "noidung"=>"naptien",
];
/* Chiết khấu admin */
$CHIETKHAU = [
 "admin"=> 0,
 "ctv"=> 0,
 "daily"=> 0,
 "member"=> 0,
];
/* Thông tin cấu hình */
$CONTACT = [
 "admin" => "Lê Quốc Đạt",
 "email" => "lequocdat206@gmail.com",
 "name" => "Lê Quốc Đạt",
 "idfb" => "100054470316074",
 "chat" => "https://facebook.com/messages/t/100054470316074",
];
/////////////////////////
$WEBSITE_URL = "https://lequocdat.com";
$domain_url = "https://lequocdat.com";
$domain_name = "Trùm Fb";
////////////////////////
$version = "1.0";
$verify = '<img src="/img/verify.png" data-toggle="tooltip" title="Tài khoản đã được xác minh" style="margin-top:-3px;width:13px;height:13px">';
$coin = '<img src="https://i.giphy.com/media/Ihy0gO3MVhUqSY2jvS/giphy.webp" style="margin-top:-5px;width:20px;height:20px">';
/* Function 1 */
include_once("API/functions.php");
/* Function 2 */
include_once("API/functions2.php");
/* Mailler */
include_once("Mailer/PHPMailerAutoload.php");
#----------------------------------------------------------------   
function SendEmail($email_nhan,$subject,$message,$bcc){
    global $emailer,$passmailer;
    $mail = new PHPMailer(); 
    $mail->SMTPDebug = 0;            
    $mail->isSMTP();         
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;   
    $mail->Username = $emailer;        
    $mail->Password = $passmailer;    
    $mail->SMTPSecure = 'tls'; 
    $mail->Port = 587;  
    $mail->setFrom('business-noreply@kunloc.com', $bcc);
    $mail->addAddress($email_nhan);
    $mail->addReplyTo('business-noreply@kunloc.com', $bcc);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->CharSet = 'UTF-8';
    $send = $mail->send();
    return $send;
}
?>