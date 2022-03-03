<?php
    require_once("../../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['type'])){
        $Case = $_POST['type'];
        switch($Case){
            case 'CONFIRM':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $table_napthe = $kunloc->query("SELECT * FROM `table_napthe` WHERE id = '$i'");
                if($table_napthe->num_rows == 1){
                    $data = $table_napthe->fetch_object();
                    $UPDATE =  $kunloc->query("UPDATE `table_napthe`  SET `trangthai` = 'Hoantat' WHERE id = '".$data->id."'");
                    if($UPDATE){
                        $kunloc->query("UPDATE `account` SET VND = VND + '".intval($data->card_price)."' WHERE username = '".$data->username."' ");
                        $noidung  = "Bạn đã nạp CARD với số tiền: ".$data->card_price."đ vào tài khoản lúc: ".$data->created_at;
                        Thongbao($data->username,$noidung);
                        $noidung2 = "".$data->username." vừa được [ADMIN] cộng: ".format_cash($data->card_price)."đ bằng phương thức CARD AUTO";
                        JSON("Thông báo", "Đã duyệt thành công","success","die","true");
                     }else JSON("Thông báo","Đã duyệt thất bại","error");

                }else JSON("Giao dịch không tồn tại", "Xin hãy thử lại","error");
            break;
            #----------------------------------------------------------------
            case 'REMOVE':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $UPDATE = $kunloc->query("UPDATE `table_napthe` SET `trangthai` = 'Thatbai' WHERE id = '$i'");
                if($UPDATE){
                  #$kunloc->query("DELETE FROM `table_napthe` WHERE id= '$i'");
                  JSON("Thông báo", "Đã từ chối thành công","success","die","true");
                }else JSON("Thông báo", "Đã duyệt thất bại","error");
            break;
        }
        
    }else JSON("Bạn không có quyền","Không thể duyệt id này","error");
?>