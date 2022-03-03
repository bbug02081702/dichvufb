<?php 
error_reporting(0);
include_once('../../config.php'); 
include_once('../../TSR/simple_html_dom.php');
$user = $thesieure['username'];
$pass = $thesieure['password'];
if($_GET) $_POST = $_GET;
if(isset($_POST['magiaodich']) && isset($_POST['password'])) {
  $TrixID = $_POST['magiaodich'];
  $password = md5(tachchuoi($_POST['password']));
  $kiemtra = $kunloc->query("SELECT * FROM account WHERE password = '$password' AND username = '$username'");
  if($kiemtra->num_rows != 1) JSON( "Mật khẩu không đúng","Mật khẩu bạn nhập không chính xác", "error");
  else login($user,$pass,$TrixID);   
} else  {
  JSON("Tạo yêu cầu xét duyệt thất bại","CODE: 1 - Có lỗi xảy ra từ hệ thống, vui lòng liên hệ admin","error");
}
function login($username,$password,$TrixID){
global $kunloc;
 $ch = curl_init();
  curl_setopt_array($ch, [
   CURLOPT_URL => "https://thesieure.com/account/login",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_SSL_VERIFYPEER => false,
   CURLOPT_TIMEOUT => 30,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_COOKIEFILE => "cookie.txt",
   CURLOPT_COOKIEJAR => "cookie.txt",
  ]);
  $exec = curl_exec($ch);
  $_csrf_token = str_get_html($exec)->find("input[name=_token]", 0)->value;
  curl_close($ch);
  #------------------------------------------------
  $curl = curl_init();
  curl_setopt_array($curl, [
   CURLOPT_URL => "https://thesieure.com/account/login",
   CURLOPT_COOKIEJAR => "cookie.txt",
   CURLOPT_COOKIEFILE => "cookie.txt",
   CURLOPT_CONNECTTIMEOUT => 30,
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_SSL_VERIFYPEER => false,
   CURLOPT_FOLLOWLOCATION => 1,
   CURLOPT_POST => 1,
   CURLOPT_POSTFIELDS => "phoneOrEmail=$username&password=$password&_token=" . $_csrf_token,
   CURLINFO_HEADER_OUT => true,
  ]);
  $exec = curl_exec($curl);
  $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  curl_close($curl);
  #------------- Fail ------------------
  if (strpos($exec, "<h4>Đăng nhập tài khoản</h4>") !== false){
   return JSON("Tạo yêu cầu xét duyệt thất bại","CODE: 2 - Có lỗi xảy ra từ hệ thống, vui lòng liên hệ admin","error");
  } else {
    $datas = getGD();
    #------------- Sucesss ------------------
    if($datas){
      foreach ($datas->find('tr') as $value) {
            $magiaodich = $value->find('td', 0)->plaintext;
            $sotien = explode("đ",$value->find('td', 1)->plaintext)[0];
            $price = str_replace(array(".",","),array("",""),$sotien);
            #-----------------------------
            $tachuser = explode("\r\n",($value->find('td', 2)->plaintext));
            $nguoigui = $tachuser[0];
            $nguoinhan = $tachuser[1];
            #-----------------------------
            $ngaygiaodich = $value->find('td', 3)->plaintext;
            $status = $value->find('td', 4)->find('span', 0)->plaintext;
            $content = $value->find('td', 5)->plaintext;
            $user = explode("naptien_",$content)[1];
            #------------------------------------
            if(isset($magiaodich) && $magiaodich == $TrixID && isset($status)  && $status == 'Thành công'){
              $kiemtraTrixID = $kunloc->query("SELECT * FROM `api_thesieure` WHERE TrixID = '$magiaodich'");
              if($kiemtraTrixID->num_rows != 1){
                  $account = $kunloc->query("SELECT * FROM account WHERE username = '$user'");
                    if($account->num_rows == 1){
                    if($content != 'null' || $content != '') $noidung = $content;
                    else $noidung = 'Trống';
                    $INSERT = $kunloc->query("INSERT INTO `api_thesieure`(`username`, `TrixID`, `content`, `price`, `created_at`, `trangthai`) 
                    VALUES ('$user',
                    '$magiaodich',
                    '$noidung',
                    '$price',
                    'success')");
                    if($INSERT){
                      $kunloc->query("UPDATE account SET VND = VND + '$price' WHERE username = '$user'");
                      #---------- Mailer -----------
                      $tieudes = 'Nạp tiền THESIEURE thành công';
                      $message = "Chào, ".$account->username."<br>
                      Hệ thống đã xác nhận yêu cầu của bạn.<br>
                      Số tiền được thêm vào tài khoản là: ".format_cash($sotien)."đ";
                      $bcc = 'THESIEURE SUPPORT';
                      SendEmail($account->email,$tieudes,$message,$bcc);  
                      return JSON("Xét duyệt thành công","- Nội dung: <b style='color:blue'>$content</b><br>
                      - Số tiền: <b style='color:red'>".format_cash($price)."</b> VND<br>
                      - Ngày: $ngaygiaodich
                      ","success");  
                    }else return JSON("Thất bại khi xét duyệt","Xin hãy kiểm tra lại","error");  

                   }else return JSON("Người dùng không tồn tại","Xin hãy kiểm tra lại","error");  

                }else return JSON("Mã giao dịch đã tồn tại","Xin hãy kiểm tra lại","error");  
                
            }else return JSON("Mã giao dịch không tồn tại","Hệ thống không tìm được: $TrixID","error");  
           
 
      }
      echo json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);    
    }else{
      return JSON("Tạo yêu cầu xét duyệt thất bại","CODE: 3 - Có lỗi xảy ra từ hệ thống","error");
    }
  }
}
function getGD(){
  $ch = curl_init();
  curl_setopt_array($ch, [
   CURLOPT_URL => "https://thesieure.com/wallet/transfer",
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_SSL_VERIFYPEER => false,
   CURLOPT_COOKIEFILE => "cookie.txt",
   CURLOPT_COOKIEJAR => "cookie.txt",
  ]);
  $exec = curl_exec($ch);
  curl_close($ch);
  $rs = str_get_html($exec);
  return $data = $rs->find('tbody', 2);
}
?>