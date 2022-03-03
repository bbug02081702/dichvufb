<?php
    require_once("../../config.php");
    if(isset($_POST['momo_number']) && $_POST['momo_number'] !== "") $momo_number = tachchuoi($_POST['momo_number']); else JSON("Thông báo", "Bạn chưa điền số momo","question");
    if(isset($_POST['momo_price']) && $_POST['momo_price'] !== "") $momo_price = tachchuoi($_POST['momo_price']); else JSON("Thông báo", "Bạn chưa điền số tiền","question");
    if(isset($_POST['password']) && $_POST['password'] !== "") $password = md5(tachchuoi($_POST['password'])); else JSON("Thông báo", "Bạn chưa điền mật khẩu","question");
    //////////////////////////////////////////////
    $kiemtra = $kunloc->query("SELECT * FROM `account` WHERE `password` = '$password' AND username = '$username'");
    if($kiemtra->num_rows != 1) JSON("Thông báo","Mật khẩu bạn nhập không chính xác","error");
    if($momo_price < 10000 || $momo_price > 1000000) JSON("Số tiền nạp không Hợp Lệ","Số tiền phải từ 10.000 > 1.000.000 VND", "error");
    //////////////////////////////////////////////
    $INSERT = $kunloc->query("INSERT INTO `table_momo`(`username`, `price`, `number`, `trangthai`, `created_at`) VALUES ('$username','$momo_price','$momo_number','fail','".time()."')");
    if($INSERT){
      $message ="$username vừa tạo 1 yêu cầu nạp tiền qua MOMO, lúc: $today";
      SendEmail($email_admin,"Thông báo nạp MOMO",$message,"SUPPORT");
      JSON( "Yêu cầu thành công","Xin đợi 24h để duyệt","success","exit",true);
      
    }else JSON("Yêu cầu thất bại","Xin hãy thử lại","error");
  
?>