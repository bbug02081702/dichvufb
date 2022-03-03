<?php
    require_once("../../config.php");
    header("Content-type:text/javascript;charset:utf-8");
    if($_GET) $_POST  = $_GET;
    if(isset($_POST['token']) && $_POST['token'] !== '') $token = tachchuoi($_POST['token']); 
    else {
     $JSON = ["status"=> 4,"msg"=> "Mã AccessToken không hợp lệ"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));       
    }
    /* Kiểm tra token */
    $kiemtratoken =  $kunloc->query("SELECT * FROM `account` WHERE token = '$token'");
    if($kiemtratoken->num_rows != 1){
     $JSON = ["status"=> 4,"msg"=> "Mã AccessToken không hợp lệ"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));     
    }
    else{
        $account = $kiemtratoken->fetch_object();
        $vnd = $account->VND;
        $level = $account->level;
        $chietkhau = $account->chietkhau;
        $username = $account->username;
    }
    ///////////////////////////////////////////
    if(isset($_POST['type']) && $_POST['type'] !== '') $type = tachchuoi($_POST['type']); 
    else{
     $JSON = ["status"=> 3,"msg"=> "Chưa có tham số type"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
    }
    if(isset($_POST['loai']) && $_POST['loai'] !== '') $loai = tachchuoi($_POST['loai']); 
    else {
     $JSON = ["status"=> 3,"msg"=> "Chưa có tham số server"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));    
    }
    if(isset($_POST['uid']) && $_POST['uid'] !== '') $uid = $kunloc->real_escape_string($_POST['uid']); 
    else{
     $JSON = ["status"=> 3,"msg"=> "Chưa có tham số uid/link"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));    
    }
    if(isset($_POST['amount']) && $_POST['amount'] !== '') $amount = tachchuoi($_POST['amount']); 
    else{
     $JSON = ["status"=> 3,"msg"=> "Chưa có tham số amount"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));       
    }
    //////////////////////////////////
    $TrixID = random('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', 12);
    $note_user = isset($_POST['note_user']) ? $_POST['note_user'] : '';
    #----------------------------------------------------------
    $service =  $kunloc->query("SELECT * FROM `table_service_server` WHERE `id` = '$loai' AND `slug`= '$type' ");
    if($service->num_rows != 1){
     $JSON = ["status"=> 999,"msg"=> "Dich vụ không hợp lệ"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
    }
    //////////////////////////////////
    $data = $service->fetch_object();
    $server = $data->server;
    $slug = $data->slug;
    if ($level == 'admin') {
        $price = $data->price_default;
    } elseif ($level == 'ctv') {
        $price = $data->price_ctv;
    } elseif ($level == 'daily') {
        $price = $data->price_daily;
    } elseif ($level == 'member') {
        $price = $data->price_default;
    }
    $amount_max = $data->amount_max;
    $amount_min = $data->amount_min;
    
    if(($return_image->mode_server_s7 == 'ON') && $data->id == 57) JSON("Dich vụ đang quá tải","Xin vui lòng chờ trong giây lát","error"); 
    #----------------------------------------------------------
    $total = ($amount*$price);
    $tongthanhtoan = Giamgia($total);
    if ($amount == '' || $amount < 1) {
      $JSON = ["status"=> 2,"msg"=> "Số lượng không hợp lệ"];
      exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
    } elseif ($amount < $amount_min) {
      $JSON = ["status"=> 2,"msg"=> "Số lượng tối thiểu cần chạy là: " . format_cash($amount_min)];
      exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
    } elseif ($amount > $amount_max) {
      $JSON = ["status"=> 2,"msg"=> "Số lượng tối đa cần chạy là: " . format_cash($amount_max)];
      exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
    } elseif ($tongthanhtoan >= $vnd || ($vnd - $tongthanhtoan) < 1) {
      $congtien = $tongthanhtoan - $vnd;
      $JSON = ["status"=> 2,"msg"=> "Số Dư Không Đủ, nạp thêm: " . format_cash($congtien) . "đ"];
      exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
    } else {
    ///////////////////////////////////////////// 
     $CREAT_DONHANG = $kunloc->query("INSERT INTO 
     `table_bill`(`TrixID`, `by_user`, `service`, `slug`, `amount`,`amount_start`,`amount_success`, `price`, `trangthai`, `uid`, `note_user`,`note_admin`,`created_at`) 
     VALUES ('$TrixID','$username','$server','$slug','$amount','0','0','$tongthanhtoan','Waiting','$uid','$note_user','','".time()."')"); 
     if($CREAT_DONHANG){
        /* Trừ tiền ĐƠN HÀNG */ 
        $kunloc->query("UPDATE `account` SET `VND` = `VND` - '".intval($tongthanhtoan)."' WHERE `username` = '$username' ");
        /* Log mua hàng */ 
        $noidung = "$username, Vừa đặt đơn hàng [$slug] với giá ".format_cash($tongthanhtoan)."đ, Được giảm giá: $chietkhau%";
        NhatkyVnd($username, $noidung, $vnd, $tongthanhtoan, ( $vnd + $tongthanhtoan ) );
        NhatkyHd($username, $noidung, $uid, $amount, $tongthanhtoan, $slug);
        /* Mailler */
        SEND_ORDER($TrixID, $server, $tongthanhtoan, $username);
        /* JSON */
        $JSON = [
          "status"=> 1,
          "service" => $server,
          "slug" => $slug,
          "loai" => $type,
          "TrixID" => $TrixID,
          "price" => $tongthanhtoan,
          "uid" => $uid,
          "trangthai"=> "Waiting",
          "amount" => $amount,
          "amount_start" => 0,
          "amount_success" => 0,
          "note_user" => $note_user,
          "note_admin" => '',
          "created_at" => time(),
          "type"=> "success",
          "title"=> "Tạo đơn hàng thành công",
          "text"=> "
            - Đơn hàng: <b>$server</b> (<b>$amount</b> Lượt) cho: <small>$uid</small><br>
            - Tổng thanh toán: <h style='color:red'>".format_cash($tongtien)."</h>đ.<br>
            - Được giảm giá: <h style='color:green'>$chietkhau</h>%, giá đã giảm là: <h style='color:red'>".format_cash($tongthanhtoan)."</h>đ.<br>
            - Ghi chú: $note_user.",
          
        ];
        echo json_encode($JSON,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
     
     }else{
        $JSON = ["status"=> 1,"msg"=> "Tạo đơn hàng thất bại"];
        exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
     }
    }

?>