<?php
    require_once("../../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['type']) && $_POST['id']){
        $Case = $_POST['type'];
        switch($Case){
            case 'CONFIRM':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $kiemtra = $kunloc->query("SELECT * FROM `table_rut_tien` WHERE id = '$i'");
                if($kiemtra->num_rows == 1){
                  $data = $kiemtra->fetch_object();
                  /////////////////////////
                  $CONFIRM = $kunloc->query("UPDATE `table_rut_tien` SET trangthai = 'success' WHERE id = '".$data->id."' ");
                  if($CONFIRM){
                  $account = $kunloc->query("SELECT * FROM account WHERE username = '".$data->username."'")->fetch_object(); 
                  $UPDATE = $kunloc->query("UPDATE account SET VND = VND + '".$data->table_price."' WHERE username = '".$data->username."' ");
                  $noidung  = "Bạn đã rút tiền với số tiền: ".format_cash($data->table_price)."đ vào tài khoản lúc: ".$data->date;
                  Thongbao($data->username,$noidung);
                  $noidung2 = "".$data->username." vừa được [ADMIN] trừ: ".format_cash($data->table_price)."đ bằng phương thức RUTTIEN";
                  NhatkyVnd($data->username,$noidung2,$account->VND,$data->table_price,($data->table_price+$account->VND));
                  NhatkyHd($data->username,$noidung2,"","",$data->table_price,'RUTTIEN');
                     
                   JSON("Thông báo","Đã duyệt thành công","success","exit","true");
                
                }else JSON("Thông báo","Đã duyệt thất bại","error");
                  
            }else JSON("Thông báo","Giao dịch không tồn tạ","error");
                  
            break;
            case 'REMOVE':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $UPDATE = $kunloc->query("DELETE FROM `table_rut_tien` WHERE id= '$i'");
                if($UPDATE) JSON("Thông báo","Đã xóa thành công","success","exit","true");
                else JSON("Thông báo", "Đã duyệt thất bại","error");
            break;
        }
        
    }else JSON("Thông báo","Bạn không có quyền","error");

?>