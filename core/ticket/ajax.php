<?php
    require_once("../../config.php");
    if($_GET) $_POST  = $_GET;
    if(empty($_POST['title']) || empty($_POST['noidung']))  JSON("Yêu cầu thông tin","Bạn chưa điền đầy đủ thông tin","question");
    ////////////////////////////////
    $TrixID = rand(10000000,90000009);
    $titles = tachchuoi($_POST['title']);;
    $noidung = $kunloc->real_escape_string($_POST['noidung']);
    #----------------------------------------------------------
    $REG = $kunloc->query("
    INSERT INTO `hop_thu_ho_tro`(`TrixID`, `username`, `title`, `noidung`, `trangthai`, `ngay`) 
    VALUES ('$TrixID','$username', '$titles','$noidung','wait','$now')");
    if($REG){
       $message ="$username vừa tạo 1 yêu cầu Ticket - Title: $titles , lúc: $today";
       SendEmail($email_admin,"Thông báo có TICKET",$message,"TICKET");
      JSON("Tạo yêu cầu thành công","Chờ reload", "success", "exit",true);
    }else JSON("Tạo yêu cầu thất bại", "Xin hãy thử lại", "error");  
?>