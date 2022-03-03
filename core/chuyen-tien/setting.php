<?php
    require_once("../../config.php");
    if(isset($_POST['type']) && $_POST['id']){
        $Case = $_POST['type'];
        switch($Case){
            case 'REMOVE':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $DELETE = $kunloc->query("DELETE FROM `table_chuyen_tien` WHERE id= '$i'");
                if($DELETE){
                  JSON("Thông báo", "Đã xoá thành công","success","die","true");
                }else JSON("Thông báo", "Đã xoá thất bại","error");
            break;
        }
    }else JSON("Bạn không có quyền","Không thể duyệt id này","error");
?>