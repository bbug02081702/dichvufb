<?php
    require_once("../../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['type'])){
        $Case = $_POST['type'];
        $i = intval($_POST['id']);
        switch($Case){
            case 'REMOVE':
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này","error"); 
                $DELETE = $kunloc->query("DELETE FROM `napthe` WHERE id= '$i'");
                if($DELETE) JSON("Thông báo","Đã xóa thành công","success","exit",true);
                else JSON("Thông báo","Đã xóa thất bại","error");
            break;
        }
    }else JSON("Bạn không có quyền","Không thể duyệt id này","error");     
?>
