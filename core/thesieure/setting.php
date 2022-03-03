<?php
    require_once("../../config.php");
    if(isset($_POST['type'])){
        $Case = $_POST['type'];
        switch($Case){
            #----------------------------------------------------------------
            case 'REMOVE':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $DELETE = $kunloc->query("DELETE FROM `table_momo` WHERE id = '$i'");
                if($DELETE) JSON("Thông báo","Đã xóa thành công", "success","exit",true);
                else JSON("Thông báo","Đã xóa thất bại","error");
             break;
        }
    }else JSON("Bạn không có quyền","Không thể duyệt id này","error");
?>