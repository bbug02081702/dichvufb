<?php
	require_once("../../config.php");
	if(isset($_POST['card_type']) && $_POST['card_type'] !== "") $card_type = tachchuoi($_POST['card_type']); else JSON("Thông báo", "Bạn chưa điền loại thẻ","question");
    if(isset($_POST['card_price']) && $_POST['card_price'] !== "") $card_price = tachchuoi($_POST['card_price']); else JSON("Thông báo", "Bạn chưa điền mệnh giá","question");
    if(isset($_POST['card_serial']) && $_POST['card_serial'] !== "") $card_serial = tachchuoi($_POST['card_serial']); else JSON("Thông báo", "Bạn chưa điền Serial","question");
    if(isset($_POST['card_code']) && $_POST['card_code'] !== "") $card_code = tachchuoi($_POST['card_code']); else JSON("Thông báo", "Bạn chưa điền PIN Code","question");
    if(strlen($card_serial) < 6 || strlen($card_serial) > 20 || strlen($card_code) < 10 || strlen($card_code) > 20){
        JSON("Thông báo", "Bạn cần nhập 10 > 20 kí tự","question");
    }
   $kiemtra_the = $kunloc->query("SELECT id FROM `table_napthe` WHERE card_code = '$card_code' AND card_serial='$card_serial'");
   if($kiemtra_the->num_rows == 1){
    JSON("Thông báo", "Thẻ đã tồn tại","question");
   }
   $INSERT = $kunloc->query("INSERT INTO `table_napthe` (card_code,card_serial,card_price, card_type, username, trangthai) VALUES ('$card_code','$card_serial','$card_price','$card_type','$username','Waiting')");
   if($INSERT){
       JSON("Gửi thành công!","Vui lòng chờ thẻ đang xử lý","success","exit",true);
   }else JSON("Thông báo", "Gửi thất bại, xin hãy thử lại","error");
?>