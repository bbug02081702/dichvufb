<?php
	require_once("../../config.php");
	if(isset($_POST['table_loai']) && $_POST['table_loai'] !== "") $table_loai = $value[tachchuoi($_POST['table_loai'])]; else JSON("Thông báo", "Bạn chưa điền loại","question");
    if(isset($_POST['table_chi_nhanh']) && $_POST['table_chi_nhanh'] !== "") $table_chi_nhanh = tachchuoi($_POST['table_chi_nhanh']); else JSON("Thông báo", "Bạn chưa điền chi nhánh","question");
    if(isset($_POST['table_name']) && $_POST['table_name'] !== "") $table_name = tachchuoi($_POST['table_name']); else JSON("Thông báo", "Bạn chưa điền tài khoản","question");
    if(isset($_POST['table_price']) && $_POST['table_price'] !== "") $table_price = tachchuoi($_POST['table_price']); else JSON("Thông báo", "Bạn chưa điền mệnh giá","question");
    if(isset($_POST['password']) && $_POST['password'] !== "") $password = md5(tachchuoi($_POST['password'])); else JSON("Thông báo", "Bạn chưa điền mật khẩu","question");
    $kiemtra = $kunloc->query("SELECT * FROM `account` WHERE password = '$password' AND username = '$username'");
    if($kiemtra->num_rows != 1){
     JSON("Mật khẩu không đúng","Mật khẩu bạn nhập không chính xác", "error");
	}
	if($table_price < 10000 || $table_price > 1000000){
     JSON("Thông báo","Mệnh giá không hợp lệ","error");
	}
    ////////////////////////////////////////
	$kiemtra_rutien = $kunloc->query("SELECT * FROM `table_bank` WHERE `table_name` = '$table_name' AND `table_price` = '$table_price' AND username = '$username'");
	if($kiemtra_rutien->num_rows >= 1){
     JSON("Thông báo","Yêu cầu này đã tồn tại","error");
	}
    ////////////////////////////////////////
    $INSERT = $kunloc->query("INSERT INTO `table_bank`( `table_name`, `table_chi_nhanh`, `table_price`, username, trangthai, created_at) VALUES ('$table_name','$table_chi_nhanh', '$table_price', '$username','fail' ,'".time()."')");
    if($INSERT){
      $tieude = 'Bạn đã tạo 1 yêu cầu';
      $message = "Chào, $username<br>
      Bạn đã tạo 1 yêu cầu nạp tiền thủ công.<br>
      Vui lòng chờ 3h-24h để xét duyệt. Cảm ơn!";
      $bcc = 'VIETCOMBANK SUPPORT';
      SendEmail($emailuser,$tieude,$message,$bcc);
      ////////////////////////////
      $tieude2 = "$username, đã tạo 1 yêu cầu";
      $message2 = "$username, đã tạo 1 yêu cầu nạp tiền qua Vietcombank.<br>
        - Số tiền: ".format_cash($table_price)."đ<br>
        - Số tài khoản: $table_name <br>
        - Người gửi: $username <br>
        - Lúc: $today";
      SendEmail($email_admin,$tieude2,$message2,$bcc);
      
      JSON("Gửi thành công!","Xin chờ 24h để xử lý","success","exit",true);  
    }else JSON("Thông báo", "Gửi thất bại, xin hãy thử lại","error");

?>