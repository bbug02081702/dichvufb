<?php
	require_once("../../config.php");
	$value = array("","ATM","ViettelPay","Zing","Garena","Moblie","Momo");
	if(isset($_POST['table_loai']) && $_POST['table_loai'] !== "") $table_loai = $value[tachchuoi($_POST['table_loai'])]; else JSON("Thông báo", "Bạn chưa điền loại","question");
    if(isset($_POST['table_chi_nhanh']) && $_POST['table_chi_nhanh'] !== "") $table_chi_nhanh = tachchuoi($_POST['table_chi_nhanh']); else JSON("Thông báo", "Bạn chưa điền chi nhánh","question");
    if(isset($_POST['table_number']) && $_POST['table_number'] !== "") $table_number = tachchuoi($_POST['table_number']); else JSON("Thông báo", "Bạn chưa điền tài khoản","question");
    if(isset($_POST['table_price']) && $_POST['table_price'] !== "") $table_price = tachchuoi($_POST['table_price']); else JSON("Thông báo", "Bạn chưa điền mệnh giá","question");
    if(isset($_POST['password']) && $_POST['password'] !== "") $password = md5(tachchuoi($_POST['password'])); else JSON("Thông báo", "Bạn chưa điền mật khẩu","question");
    ////////////////////////////////////////
    
    $kiemtra = $kunloc->query("SELECT * FROM `account` WHERE password = '$password' AND username = '$username'");
    if($kiemtra->num_rows != 1){
     JSON("Mật khẩu không đúng","Mật khẩu bạn nhập không chính xác", "error");
	}
	if($vnd < $table_price || $vnd < 1){
	 JSON("Số dư không đủ","Vui lòng nạp thêm tiền","error");
    }else if($table_price < 50000 || $table_price > 500000){
     JSON("Thông báo","Mệnh giá không hợp lệ","error");
	}
	////////////////////////////////////////
	$kiemtra_rutien = $kunloc->query("SELECT * FROM `table_rut_tien` WHERE `table_number` = '$table_number' AND `table_price` = '$table_price' AND username = '$username'");
	if($kiemtra_rutien->num_rows >= 1){
     JSON("Thông báo","Yêu cầu này đã tồn tại","error");
	}
    ////////////////////////////////////////
    $INSERT = $kunloc->query("INSERT INTO `table_rut_tien`(`table_loai`, `table_number`, `table_chi_nhanh`, `table_price`, username, trangthai, created_at) VALUES ('$table_loai','$table_number','$table_chi_nhanh', '$table_price', '$username','fail' ,'".time()."')");
    if($INSERT){
      $kunloc->query("UPDATE `account` SET VND = VND - '".intval($table_price)."' WHERE username = '$username' "); 
      JSON("Gửi thành công!","Xin chờ 24h để xử lý","success","exit",true);  
    }else JSON("Thông báo", "Gửi thất bại, xin hãy thử lại","error");
?>