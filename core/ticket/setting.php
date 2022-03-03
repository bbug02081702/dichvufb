<?php
require_once("../../config.php");
if($_GET) $_POST = $_GET;
if(isset($_POST['type'])){
    switch($_POST['type']){
     case 'delete':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Còn thiếu ID Table","question" );
        $i = intval($_POST['id']); 
        if($level == 'admin'){
          $REMOVE = mysqli_query($kunloc,"DELETE FROM hop_thu_ho_tro WHERE id='$i'");
          if($REMOVE) JSON("Delete","Đã xóa thành công","success", "exit",true);    
        }else{
          $REMOVE = mysqli_query($kunloc,"DELETE FROM hop_thu_ho_tro WHERE id='$i' AND username = '$username' ");
          if($REMOVE) JSON("Delete Done","Đã xóa thành công","success","reload" ,true); 
         }
      break;
    }
}else JSON("Đã xảy ra lỗi","Bạn vui lòng kiểm tra lại!","error");
?>