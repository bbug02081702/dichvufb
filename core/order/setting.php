<?php
require_once("../../config.php");
if($_GET) $_POST = $_GET;
if(isset($_POST['type'])){
    switch($_POST['type']){
     case 'SERVICE_CREATED':
        if(isset($_POST['service']) && $_POST['service'] !== '') $service = tachchuoi($_POST['service']); else JSON("Bạn chưa nhập Server","Vui lòng thử lại","error");
        if(isset($_POST['banner']) && $_POST['banner'] !== '') $banner = $kunloc->real_escape_string($_POST['banner']); else JSON("Bạn chưa thêm banner ảnh","Vui lòng thử lại","error");
        if(isset($_POST['content']) && $_POST['content'] !== '') $content = $kunloc->real_escape_string($_POST['content']); else JSON("Bạn chưa thêm mô tả dịch vụ","Vui lòng thử lại","error");
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $slug = text($service);
        $REG = $kunloc->query("INSERT INTO 
        `table_service`(`service`, `slug`, `banner`, `content`) 
        VALUES ('$service','$slug','$banner','$content')");
        if($REG) JSON("Tạo dịch vụ thành công","Chờ reload","success", "die", true);
        else JSON("Tạo dịch vụ thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////
     case 'MENU_CREATED':
        
        if(isset($_POST['service_menu']) && $_POST['service_menu'] !== '') $service = tachchuoi($_POST['service_menu']); else JSON("Bạn chưa nhập Server","Vui lòng thử lại","error");
        if(isset($_POST['banner_menu']) && $_POST['banner_menu'] !== '') $banner = $kunloc->real_escape_string($_POST['banner_menu']); else JSON("Bạn chưa thêm banner ảnh","Vui lòng thử lại","error");
        if(isset($_POST['trangthai']) && $_POST['trangthai'] !== '') $trangthai = tachchuoi($_POST['trangthai']); else JSON("Bạn chưa chọn trạng thái","Vui lòng thử lại","error");
        if(isset($_POST['slug']) && $_POST['slug'] !== '') $slug = $kunloc->real_escape_string($_POST['slug']); else JSON("Bạn chưa chọn loại service","Vui lòng thử lại","error");
        if($level != 'admin')JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $type = text($service);
        $REG = $kunloc->query("INSERT INTO 
        `table_service_menu`( `type`, `slug`,`banner`,`service`,`trangthai`) 
        VALUES ('$type','$slug','$banner','$service','$trangthai')");
        
        if($REG) JSON("Tạo thành công","Xin hãy chờ reload","success", "die" , true);
        else JSON("Tạo thất bại","Xin hãy thử lại","error");
      break;
      /////////////////////////////////////////
        case 'SERVER_CREATED':

        if(isset($_POST['service_server']) && $_POST['service_server'] !== '') $server = tachchuoi($_POST['service_server']); else JSON("Bạn chưa nhập Server","Vui lòng thử lại","error");
        if(isset($_POST['price_default']) && $_POST['price_default'] !== '') $price_default = tachchuoi($_POST['price_default']); else JSON("Bạn chưa thêm giá gốc","Vui lòng thử lại","error");
        if(isset($_POST['price_daily']) && $_POST['price_daily'] !== '') $price_daily = tachchuoi($_POST['price_daily']); else JSON("Bạn chưa thêm giá cho đại lý","Vui lòng thử lại","error");
        if(isset($_POST['price_ctv']) && $_POST['price_ctv'] !== '') $price_ctv = tachchuoi($_POST['price_ctv']); else JSON("Bạn chưa thêm giá cho cộng tác viên","Vui lòng thử lại","error");
        if(isset($_POST['content']) && $_POST['content'] !== '') $content = $kunloc->real_escape_string($_POST['content']); else JSON("Bạn chưa thêm content","Vui lòng thử lại","error");
        if(isset($_POST['amount_min']) && $_POST['amount_min'] !== '') $amount_min = tachchuoi($_POST['amount_min']); else JSON("Bạn chưa nhập tối thiểu","Vui lòng thử lại","error");
        if(isset($_POST['amount_max']) && $_POST['amount_max'] !== '') $amount_max = tachchuoi($_POST['amount_max']); else JSON("Bạn chưa nhập tối đa","Vui lòng thử lại","error");
        if(isset($_POST['trangthai_server']) && $_POST['trangthai_server'] !== '') $trangthai = tachchuoi($_POST['trangthai_server']); else JSON("Bạn chưa chọn trạng thái","Vui lòng thử lại","error");
        if(isset($_POST['slug_server']) && $_POST['slug_server'] !== '') $slug = $kunloc->real_escape_string($_POST['slug_server']); else JSON("Bạn chưa chọn loại service","Vui lòng thử lại","error");
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $type = text($server);
        $REG = $kunloc->query("INSERT INTO 
        `table_service_server`(`type`, `slug`, `server`, `price_default`,`price_daily`,`price_ctv`, `amount_min`, `amount_max`, `content`, `trangthai`) 
        VALUES ('$type','$slug','$server','$price_default','$price_daily','$price_ctv','$amount_min','$amount_max','$content','$trangthai')
        ");
        if($REG) JSON("Tạo option thành công","Chờ reload","success","die",true);
        else JSON("Tạo option thất bại","Xin hãy thử lại","error");
        
     break;
     /////////////////////////////////////////
     case 'REMOVE_SERVICE':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $delete = $kunloc->query("DELETE FROM `table_service` WHERE id='$i'");
        if($delete) JSON("Delete thành công","Đã xóa thành công","success","die",true); 
        else JSON("Delete thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////
     case 'REMOVE_MENU':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $delete = $kunloc->query("DELETE FROM `table_service_menu` WHERE id='$i'");
        if($delete) JSON("Delete thành công","Đã xóa thành công","success","die",true); 
        else JSON("Delete thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////
     case 'REMOVE_SERVER':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $delete = $kunloc->query("DELETE FROM `table_service_server` WHERE id='$i'");
        if($delete) JSON("Delete thành công","Đã xóa thành công","success","die",true); 
        else JSON("Delete thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////   
     case 'REMOVE_BILL':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        /////////////////////////////////////////
        $delete = $kunloc->query("DELETE FROM `table_bill` WHERE id='$i'");
        if($delete) JSON("Delete thành công","Đã xóa thành công","success","die",true); 
        else JSON("Delete thất bại","Xin hãy thử lại","error");
      break;
      /////////////////////////////////////////
      case 'Success':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'")->fetch_object();
        if(isset($table_bill->id)) $UPDATE = $kunloc->query("UPDATE `table_bill` SET trangthai = 'Success' WHERE id='$i'");
        if($UPDATE){
            DUYET_ORDER($table_bill->username,$table_bill->TrixID);
            JSON("Đã duyệt yêu cầu này","Đã duyệt thành công","success");
        }else JSON("Duyệt yêu cầu thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////
     case 'Active':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'")->fetch_object();
        if(isset($table_bill->id)) $UPDATE = $kunloc->query("UPDATE `table_bill` SET trangthai = 'Active' WHERE id='$i'");
        if($UPDATE){
            RUN_ORDER($table_bill->username,$table_bill->TrixID);
            JSON("Đã duyệt yêu cầu này","Đã duyệt thành công","success");
        }else JSON("Duyệt yêu cầu thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////
     case 'Cancel':
        if(empty(intval($_POST['id']))) JSON("Yêu cầu thông tin ID","Yêu cầu thông tin ID","error");
        $i = intval($_POST['id']); 
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'")->fetch_object();
        if(isset($table_bill->id)) $UPDATE = $kunloc->query("UPDATE `table_bill` SET trangthai = 'Cancel' WHERE id='$i'");
        if($UPDATE){
         $backmoney = $kunloc->query("UPDATE account SET VND = VND + '".intval($table_bill->price)."' WHERE username = '".$table_bill->by_user."'");
         $cancel = HUY_ORDER($table_bill->by_user,$table_bill->TrixID);
         JSON("Đã back yêu cầu này","Đã hoàn số tiền: ".format_cash($table_bill->price),"success");
        }else JSON("Duyệt yêu cầu thất bại","Xin hãy thử lại","error");
     break;
     /////////////////////////////////////////
     case 'AMOUNT_START':
        if(empty($_POST['id'] >= 0) || empty($_POST['limit'] >= 0)) JSON("Yêu cầu thông tin ID - limit","Còn thiếu id - limit","error");
        
        $i = intval($_POST['id']); 
        $amount_start = intval($_POST['limit']); 
        if($amount_start < 1 || $amount_start > 10000) JSON("Yêu cầu limit","Limit phải từ 1 > 10.000","error");
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        
        $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'");
        if($table_bill->num_rows == 1) $UPDATE = $kunloc->query("UPDATE `table_bill` SET `amount_start` = '$amount_start' WHERE id='$i'");
        if($UPDATE){
             $table_bill = $table_bill->fetch_object();
              $JSON = [
                    "title" => "Đã set yêu cầu này",
                    "text" => "Đã set thành công",
                    "type" => "success",
                    "limit" => $table_bill->amount_start,
             ];
         die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }else JSON("SET yêu cầu thất bại","Xin hãy thử lại","error");
 
    break;
    /////////////////////////////////////////
    case 'AMOUNT_SUCCESS':
       if(empty($_POST['id'] >= 0) || empty($_POST['limit'] >= 0)) JSON("Yêu cầu thông tin ID - limit","Còn thiếu id - limit","error");
       $i = intval($_POST['id']); 
       $amount_success = intval($_POST['limit']); 
       if($amount_success < 1 || $amount_success > 10000) JSON("Yêu cầu limit","Limit phải từ 1 > 10.000","error");
       if($level != 'admin')JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
       $table_bill = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'");
       if($table_bill->num_rows == 1) $UPDATE = $kunloc->query("UPDATE `table_bill` SET `amount_success` = '$amount_success' WHERE id='$i'");
       if($UPDATE){
          $table_bill = $table_bill->fetch_object();
            $JSON = [
             "title" => "Đã set yêu cầu này",
             "text" => "Đã set thành công",
             "type" => "success",
             "limit" => $table_bill->amount_success,
           ];
        die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }else JSON("SET yêu cầu thất bại","Xin hãy thử lại","error");
          
     break;
     /////////////////////////////////////////
     case 'NOTE_ADMIN':
        if(empty($_POST['text']) && empty($_POST['id'] >= 0)) JSON("Yêu cầu thông tin text or ID","Còn thiếu text","error");
        
        $i = intval($_POST['id']); 
        $note_admin = tachchuoi($_POST['text']); 
        #if($note_admin < 1 || $note_admin > 10000) JSON("Yêu cầu Ghi chú","Ghi chú phải từ 1 > 10.000 kí tự","error");
        
        if($level != 'admin') JSON("Bạn không thể làm điều này!","Xin hãy thử lại sau","success");
        
        $getinfo = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'")->fetch_object();
        if($getinfo->id) $UPDATE = $kunloc->query("UPDATE `table_bill` SET `note_admin` = '$note_admin' WHERE id='$i'");
        if($UPDATE){
           $getinfo2 = $kunloc->query("SELECT * FROM `table_bill` WHERE id= '$i'")->fetch_object();
             $JSON = [
               "title" => "Đã update yêu cầu này",
               "text" => $note_admin,
               "type" => "success",
           ];
          die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }else JSON("SET yêu cầu thất bại","Xin hãy thử lại","error");
       break;
       /////////////////////////////////////////
      case 'GETCONTENT':
        if(empty($_POST['id'])) JSON("Yêu cầu thông tin ID - limit","Còn thiếu id - limit","error");
        $i = intval($_POST['id']); 
        $kiemtra = $kunloc->query("SELECT * FROM order_option WHERE id = '$i'");
        if($kiemtra->num_rows == 1){
          $kiemtra = $kiemtra->fetch_object();
          echo $JSON = json_encode([ "mota" => $kiemtra->content]);
        }else echo $JSON = json_encode([ "mota" => "Không có mô tả nào."]);
      break;
     
    }
}else{
    $JSON = array(
        "title" => "Đã xảy ra lỗi",
        "text" => "Bạn vui lòng kiểm tra lại!",
        "type" => "error",
    );
    die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
?>