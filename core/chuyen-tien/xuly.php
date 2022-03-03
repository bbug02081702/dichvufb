<?php
    require_once("../../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['to_user']) && $_POST['to_user'] !== "") $to_user = strtolower(tachchuoi($_POST['to_user'])); else JSON("Thông báo", "Bạn chưa điền người nhận","question");
    if(isset($_POST['price']) && $_POST['price'] !== "") $price = tachchuoi($_POST['price']); else JSON("Thông báo", "Bạn chưa điền số tiền","question");
    ////////////////////////////////
    if($vnd < $price || $vnd < 1) JSON("Số dư không đủ","Kiếm thêm rồi thử lại","question");
    if($price < 10000 || $price > 500000) JSON( "Thông báo","Chuyển tối thiểu 10,000 > 500.000 Xu", "question");
    ////////////////////////////////
    $kiemtra = $kunloc->query("SELECT * FROM `account` WHERE (`username` = '$to_user' OR `email` = '$to_user')");
    $data = $kiemtra->fetch_object();
    if($kiemtra->num_rows != 1) JSON("Thông báo","Người dùng không tồn tại!","question");
    /////////////////////////////////
    else if($data->username == $username) JSON("Thông báo","Bạn không thể tự chuyển cho mình", "question");  
    if($kiemtra->num_rows == 1){
    $table_chuyen_tien = $kunloc->query("INSERT INTO `table_chuyen_tien`(username,price,by_user,to_user,created_at) VALUES ('$username','$price','$username','$to_user','".time()."') ");
      if($table_chuyen_tien){
        $kunloc->query("UPDATE account SET VND = VND - $price WHERE username = '$username'");
        $kunloc->query("UPDATE account SET VND = VND + $price WHERE username = '$to_user'");
        JSON("Thông báo", "Đã chuyển: ".format_cash($price)." cho $to_user","success","exit",true);

      }else JSON("Thông báo","Đã chuyển thất bại, xin hãy thử lại","error");
    }
?>