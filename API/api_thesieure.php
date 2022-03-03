<?php 
error_reporting(0);
include ('../config.php'); 
include ('../TSR/simple_html_dom.php');
header("Content-type:text/javascript;");
$user = $thesieure['username'];
$pass = $thesieure['password'];
Echo login($user,$pass);   
function login($username,$password){
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
   return json_encode(["status" => "false", "msg" => "login fail"]);
  } else {
    $datas = getGD();
    #------------- Sucesss ------------------
    if($datas){
      foreach ($datas->find('tr') as $value) {
            $magiaodich = $value->find('td', 0)->plaintext;
            $sotien = explode("đ",$value->find('td', 1)->plaintext)[0];
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
            $getlog = $kunloc->query("SELECT * FROM `api_thesieure` WHERE TrixID = '$magiaodich'");
            if($getlog->num_rows != 1 && $status == 'Thành công'){
            $kiemtraccount = $kunloc->query("SELECT * FROM account WHERE username = '$user'");
                if($kiemtraccount->num_rows == 1){
                if($content != 'null' || $content != '') $noidung = $content;
                else $noidung = 'Trống';
                $sotien = str_replace(array(".",","),array("",""),$sotien);
                $INSERT = $kunloc->query("INSERT INTO `api_thesieure`(`username`, `TrixID`, `content`, `price`, `created_at`, `trangthai`) 
                        VALUES ('$user',
                                '$magiaodich',
                                '$noidung',
                                '$sotien',
                                '$ngaygiaodich',
                                'fail')");
                if($INSERT){
                  $kiemtraccount->fetch_object();
                  $kunloc->query("UPDATE account SET VND = VND + '".intval($sotien)."' WHERE username = '$user'");  
                  Lichsu($username,"NẠP THESIEURE thành công",$kiemtraccount->VND,intval($sotien));
                  /* Send email cho người dùng */ 
                    $tieu_de = 'Nạp tiền THESIEURE thành công';
                    $message = "Người dùng: $user<br>
                    - Đã nạp tiền thành công qua Thẻ Siêu Rẻ.<br>
                    - Số tiền được thêm vào tài khoản là: ".format_cash($sotien)."đ";
                    $bcc = 'THESIEURE SUPPORT';
                  SendEmail($email_admin,$tieu_de,$message,$bcc);  
                }
                    
                }
            }
            $JSON[] = array(
                 "TrixID" => $magiaodich,
                 "type" => "success",
                 "status" => $status,
                 "sotien" => str_replace(array(".",","),array("",""),$sotien),
                 "nguoigui" => $nguoigui,
                 "nguoinhan" => $nguoinhan,
                 "date" => date("H:i:s d-m-Y",strtotime($ngaygiaodich)),
                 "content" => $content,
           ); 
      }
      echo json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);    
    }else{
      return json_encode(["status" => "false", "msg" => "login fail"]);  
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