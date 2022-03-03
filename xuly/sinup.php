<?php
Class SinupAcconut {
    public $sinup_username;
    public $sinup_password;
    public $sinup_fullname;
    public $sinup_email;
    public $sinup_phone;
    public function Start(){
        global $kunloc;
        global $today;
        global $WEBSITE_URL;
        global $ip;
        ////////////////////////////
        global $sinup_username;
        global $sinup_password;
        global $sinup_fullname;
        global $sinup_email;
        global $sinup_phone;
        #----------------------------------------------------------------------------------
        if(strlen($sinup_username) < 6 || strlen($sinup_username) > 55) JSON("Yêu cầu thông tin","Bạn cần nhập tối thiểu từ 6 > 55","question");
        if(strlen($sinup_fullname) < 6 || strlen($sinup_fullname) > 55) JSON("Yêu Cầu Họ Tên","Tên phải tối thiểu 6 > 50 chữ","question");
        if(strlen($sinup_phone) < 9 || strlen($sinup_phone) > 11) JSON("Số Điện Thoại","Yêu cầu nhập đúng số điện thoại","question");
        if(strlen($sinup_password) < 6 || strlen($sinup_password) > 100) JSON("Yêu cầu thông tin","Yêu cầu mật khẩu 6 > 100 kí tự","question");
        
        if(!preg_match("#[0-9]+#", $sinup_password) ) JSON("Yêu cầu thông tin","Mật khẩu phải có 1 con số ","question");
        if(!preg_match("#[a-z]+#", $sinup_password) ) JSON("Yêu cầu thông tin","Mật khẩu phải có 1 chữ cái","question");
        
        $pattern = '#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
        if(preg_match($pattern, $sinup_email, $match) != 1) JSON("Yêu cầu thông tin","Địa chỉ email không hợp lệ","error");
        #---------------------------------------------------
        if($kunloc->query("SELECT * FROM account WHERE username = '$sinup_username'")->num_rows >= 1) JSON("Tài Khoản Đã Tồn Tại","Xin hãy thử lại với tên khác","error");
        if($kunloc->query("SELECT * FROM account WHERE phone = '$sinup_phone'")->num_rows >= 1) JSON("Số điện thoại đã tồn tại","Xin hãy thử lại với số khác","error");
        if($kunloc->query("SELECT * FROM account WHERE email = '$sinup_email'")->num_rows  >= 1) JSON("Email Đã Tồn Tại","Xin hãy thử lại với email khác","error");
        #-------------------------------------------------------------
        $sinup_token = $this->RandomString(30); 
        $sinup_confirm_code = $this->RandomNumber(6);
        $sinup_avatar = "data/none.jpg";
        $ip = isset($ip) ? $ip : 0;
        /* Bắt đầu thêm vào data */
        $insert = $kunloc->query("INSERT INTO 
        `account`(`username`, `password`,`VND`,`chietkhau`,`fullname`,`email`, `phone`, `level`, `kichhoat`, `avatar`,`ip`, `token`,`confirm_code`,`created_at`) 
        VALUES ('$sinup_username','$sinup_password','0','0','$sinup_fullname','$sinup_email','$sinup_phone','member','fail','$sinup_avatar','$ip','$sinup_token','$sinup_confirm_code','".time()."')");
        
        $login = $kunloc->query("SELECT * FROM `account` WHERE username = '$sinup_username' AND password ='$sinup_password'");
        if($insert && $login):
        $account = $login->fetch_object();
        return JSON("Tham Gia Thành Công",
        "- Xin chào: <h style='color:red'>".$account->fullname."</h><br>
        - Tài khoản: <h style='color:blue'>".$account->username."</h><br>
        - Số dư: <h style='color:green'>".$account->VND."</h>đ<br>
        - Email: <h style='color:orange'>".$account->email."</h><br>
        - Số điện thoại: <h style='color:black'>".$account->phone."</h><br>
        - Ngày tham gia: <h style='color:red'>".date("d/m/Y",$account->created_at)."</h><br>
        ","success");
      else: return JSON("Có lỗi xảy ra","Xin hãy thử lại","error"); endif;
    }
    public function RandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function RandomNumber($length) {
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                        $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
       return $randomString;
    }
}
include_once("../config.php");
if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['fullname']) || empty($_POST['email']) || empty($_POST['phone'])){
  JSON("Yêu cầu thông tin","Bạn cần điền đầy đủ các trương ở trên để tiến hành đăng ký","question");
}
$sinup_username = strtolower(tachchuoi($_POST['username']));
$sinup_password = md5(tachchuoi($_POST['password']));
$sinup_fullname = tachchuoi($_POST['fullname']);
$sinup_email = $kunloc->real_escape_string($_POST['email']);
$sinup_phone = tachchuoi($_POST['phone']);
#=========================================================
$Data = new SinupAcconut();
$Data->sinup_username = $sinup_username;
$Data->sinup_password = $sinup_password;
$Data->sinup_fullname = $sinup_fullname;
$Data->sinup_email = $sinup_email;
$Data->sinup_phone = $sinup_phone;
$Data->Start();
?>