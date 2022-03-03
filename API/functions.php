<?php

function NhatkyVnd($username,$message,$price_default,$price_change,$price_present){
 global $kunloc;
 $kunloc->query("INSERT INTO `table_chi_tieu`(`username`, `message`, `price_default`, `price_change`, `price_present`, `created_at`) 
 VALUES('$username','$message','$price_default','$price_change','$price_present','".time()."')");
}
function NhatkyHd($username,$message,$uid="",$amount=0,$price=0,$type){
 global $kunloc; 
 $kunloc->query("INSERT INTO table_history(`username`, `message`, `uid`, `amount`, `price`, `created_at`, `type`) 
 VALUES('$username','$message','$uid','$amount','$price','".time()."','$type')");
}
function Thongbao($username,$message){
 global $kunloc;
 $kunloc->query("INSERT INTO table_notification(`message`,`username`,`trangthai`) 
 VALUES ('$message','$username','show')");
}
function JSON($title,$text,$type,$mode="die",$reload=''){
global $time_swal;
    if($mode == 'die' || $mode == 'exit'){
      if($reload == '') $JSON = ["title" => $title,"text" => $text,"type" => $type];
      else $JSON = ["title" => $title,"text" => $text,"type" => $type,"reload" => $reload,"time"=> $time_swal];
      return $result = exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)); 
    }else{
      if($reload == '') $JSON = ["title" => $title,"text" => $text,"type" => $type];
      else $JSON = ["title" => $title,"text" => $text,"type" => $type,"reload" => $reload,"time"=> $time_swal];
      return $result = print(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
    }
}

function Trangthai(){
global $trangthai;
    if($trangthai === 'fail'){
        $JSON = array(
         "title" => "Xin lỗi, bạn không thể mua gói vào lúc này.",
         "text" => "Tài khoản của bạn chưa được kích hoạt bởi admin, vui lòng liên hệ bộ phận hỗ trợ.",
          "type" => "info",
         );
      return die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
function Chietkhau($sotien){
 global $hoahong;
 $giamgia = $hoahong/100;
 $thanhtien = intval($sotien);
 return $thanhtien-($thanhtien * $giamgia);
}
function Giamgia($sotien){
 global $chietkhau;
 $giamgia = $chietkhau/100;
 $thanhtien = intval($sotien);
 return $thanhtien-($thanhtien * $giamgia);
}
if(isset($_GET['CHECKEY'])){
  $kiemtrakey = json_decode('{"title":"Active Version","text":"Key b\u1ea3n quy\u1ec1n \u0111ang ho\u1ea1t \u0111\u1ed9ng","type":"success"}');
  exit(json_encode($kiemtrakey));
}
function SEND_ORDER($TrixID,$loai,$tongthanhtoan,$username){
    global $kunloc,$email,$email_admin;
#---------- Mailer -----------
    $tieude = 'Thông báo đơn hàng mới';
    $noidung = 'Bạn đã tạo 1 đơn hàng';
    $message = Donhang($tieude,$noidung,$loai,$TrixID,$tongthanhtoan);
    $bcc = 'SUPPORT';
    SendEmail($email,$tieude,$message,$bcc);
    $tieude2 = 'Thông báo đơn hàng mới';
    $noidung2 = "$username đã đặt 1 đơn hàng";
    $message2 = Donhang($tieude2,$noidung2,$loai,$TrixID,$tongthanhtoan);
    $bcc2 = 'CÓ ĐƠN ĐẶT HÀNG MỚI';
    SendEmail($email_admin,$tieude2,$message2,$bcc2);
}
function Donhang($tieude,$noidung,$loai,$TrixID,$tongthanhtoan){
    global $vnd,$username,$hoten,$today;
    $message = "Xin chào $hoten,<br>
    - $tieude , $noidung.<br>
    - Gói: $loai.<br>
    - Tổng thanh toán: ".format_cash($tongthanhtoan)." đ<br>
    - Vào lúc: $today<br>
    - Sô dư dự kiến: ".format_cash($vnd-$tongthanhtoan).",<br>
    => Mã giao dịch: #$TrixID. ";
    return $message;
}
function RUN_ORDER($user,$TrixID){
    global $kunloc;
    #---------- Mailer -----------
    $tieude = 'Thông báo tình trạng đơn hàng';
    $message =
    "Xin chào,$user <br>Đơn hàng #$TrixID của bạn - Đã được chạy trên hệ thống.<br>
    Vui lòng lòng đăng nhập để kiểm tra";
    $bcc = 'Đơn hàng đang được chạy';
    $getemail = $kunloc->query("SELECT * FROM account WHERE username = '$user'")->fetch_object();
    SendEmail($getemail->email, $tieude,$message,$bcc);
}
function DUYET_ORDER($user,$TrixID){
    global $kunloc;
    #---------- Mailer -----------
    $tieude = 'Thông báo tình trạng đơn hàng';
    $message =
    "Xin chào,$user <br>Đơn hàng #$TrixID của bạn - Đã hoàn thành.<br>
    Vui lòng lòng đăng nhập để kiểm tra";
    $bcc = 'Đơn hàng đã hoàn thành';
    $getemail = $kunloc->query("SELECT * FROM account WHERE username = '$user'")->fetch_object();
    SendEmail($getemail->email, $tieude,$message,$bcc);
}
function HUY_ORDER($user,$TrixID){
    global $kunloc;
    #---------- Mailer -----------
    $tieude = 'Thông báo tình trạng đơn hàng';
    $message_ = "Xin chào, $user <br>
    Đơn hàng #$TrixID của bạn - Đã bị hủy bỏ và hoàn lại tiền.<br>
    Vui lòng lòng đăng nhập để kiểm tra";
    $bcc = 'Đã hủy bỏ đơn hàng';
    $getemail = $kunloc->query("SELECT * FROM account WHERE username = '$user'")->fetch_object();
    SendEmail($getemail->email,$tieude,$message_,$bcc);
}
function getStatus($status){
    if($status == 'Active') {
        $data = '<span class="badge badge-info">Đang chạy</span>';
    } else if($status == 'Waiting' || $status == 'Pending') {
        $data = '<span class="badge badge-warning">Đang chờ xử lý</span>';
    } else if($status == 'Pause') {
        $data = '<span class="badge badge-danger">Đơn bị huỷ</span>';
    } else if($status == 'Success') {
        $data = '<span class="badge badge-success">Hoàn thành</span>';
    } else {
        $data = '<span class="badge badge-primay">'.$status.'</span>';
    }
    return $data;
}
function text($strTitle){
    $strTitle=strtolower($strTitle);
    $strTitle=trim($strTitle);
    $strTitle=str_replace(' ','-',$strTitle);
    $strTitle=preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/",'o',$strTitle);
    $strTitle=preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/",'o',$strTitle);
    $strTitle=preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/",'a',$strTitle);
    $strTitle=preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/",'a',$strTitle);
    $strTitle=preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/",'e',$strTitle);
    $strTitle=preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/",'e',$strTitle);
    $strTitle=preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/",'u',$strTitle);
    $strTitle=preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/",'u',$strTitle);
    $strTitle=preg_replace("/(ì|í|ị|ỉ|ĩ)/",'i',$strTitle);
    $strTitle=preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/",'i',$strTitle);
    $strTitle=preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/",'y',$strTitle);
    $strTitle=preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/",'y',$strTitle);
    $strTitle=str_replace('đ','d',$strTitle);
    $strTitle=str_replace('Đ','d',$strTitle);
    $strTitle=preg_replace("/[^-a-zA-Z0-9]/",'',$strTitle);
    return $strTitle;
}
function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    return random_color_part() . random_color_part() . random_color_part();
}

function RandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function RandomNumber($length) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
       $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
   return $randomString;
}
function random($string, $int){
    $chars = $string;  
    $data = substr(str_shuffle($chars), 0, $int);
    return $data;
}
function tachchuoi($value){
    return str_replace(array('<',"'",'>','?','/',"\\",'--','eval(','<php'),array('','','','','','','','',''),htmlspecialchars(addslashes(strip_tags($value))));
}
function format_cash($price){
    return str_replace(",", ".", number_format($price));
}
function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>