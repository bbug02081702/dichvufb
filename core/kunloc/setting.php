<?php
    require_once("../../config.php");
    if($_GET) $_POST = $_GET;
    if($_POST && isset($_POST['case'])){
        $Case = $_POST['case'];
        switch($Case){
          case 'REMOVE_THONGBAO':
            $i = $_POST['id'];
            if($level != 'admin') JSON("Bạn không có quyền","Xin hãy thử lại","question");
            $DELETE = $kunloc->query("DELETE FROM `table_notification_website` WHERE id = '$i'");
            JSON("Đã xóa thông báo", "Chờ reload","success","exit",true);
          break;
          case 'HIDE_THONGBAO':
            $i = $_POST['id'];
            if($level != 'admin')JSON( "Bạn không có quyền","Xin hãy thử lại", "question");
               
           $kiemtra = $kunloc->query("SELECT * FROM `table_notification_website` WHERE id = '$i'");
           if($kiemtra->num_rows == 1){
              $kiemtra = $kiemtra->fetch_object();
              if($kiemtra->trangthai == 'show'){
                 $kunloc->query("UPDATE `table_notification_website` SET trangthai='hide' WHERE id = '$i'");
                 JSON( "Đã hide thông báo", "Chờ reload","success","exit",true);
               }else{
                $kunloc->query("UPDATE `table_notification_website` SET trangthai='show' WHERE id = '$i'");
                JSON( "Đã show thông báo","Chờ reload", "success", "exit",true);
              }
            }
          break;
          case 'THONGBAO': 
             if(empty($_POST['noidung'])) JSON( "Yêu cầu thông báo","Bạn chưa điền đầy đủ thông báo","info");
             if($level != 'admin') JSON("Bạn không có quyền","Xin hãy thử lại","question");
             $noidung = $_POST['noidung'];
             $INSERT = $kunloc->query("INSERT INTO `table_notification_website`(noidung,trangthai,created_at) VALUES ('$noidung','show','".time()."') ");
             if($INSERT) JSON( "Đã tạo thông báo", "Chờ reload","success","exit",true);
             else JSON( "Tạo thông báo thất bại", "Xin hãy thử lại","error");
          break; 
          case 'UPDATES':
            $type = $_POST['type'];
            $URLIMG = addslashes($_POST['URL']);
            if($level != 'admin')JSON( "Bạn không có quyền","Xin hãy thử lại", "question");
            if(empty($URLIMG)){
                JSON( "Yêu cầu $URLIMG","Bạn chưa tải lên img","error");
            }
            $kiemtra = $kunloc->query("SELECT * FROM setting");
            if($kiemtra->num_rows == 1){
                $kunloc->query(
                "UPDATE `setting` SET `$type` = '$URLIMG' WHERE id=1");
                JSON("Lưu ảnh thành công","Chờ reload","success");
            }
          break;
          case 'TEXT':
            $type = $_POST['type'];
            $value = isset($_POST['value']) ? $_POST['value'] : '';  
            if($level != 'admin')JSON( "Bạn không có quyền","Xin hãy thử lại", "question");
            if(empty($value)) JSON( "Yêu cầu $type","Bạn chưa điền $type","error");
            $kiemtra = $kunloc->query("SELECT id FROM setting");
            if($kiemtra->num_rows == 1){
                $kunloc->query(
                "UPDATE `setting` SET  `$type` = '$value' WHERE id=1");
                 JSON("Đã cập nhât dữ liệu","Hãy tải tại trang","success");
            }
          break;
        }
    }

?> 