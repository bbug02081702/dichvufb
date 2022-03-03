<?php
Class Login {
 public $username;
 public $password;
 public function Start(){
    global $kunloc;
    global $username;
    global $password;
    /////////////////////////////////////////
    if(strlen($username) < 6 || strlen($username) > 55) JSON("Yêu cầu thông tin","Bạn cần nhập tối thiểu từ 6 > 55","info");
    if(strlen($password) < 6 || strlen($password) > 55) JSON("Yêu cầu thông tin","Bạn cần nhập tối thiểu từ 6 > 55","info");
    /////////////////////////////////////////
    $kiemtra_account = $kunloc->query("SELECT * FROM `account` WHERE username ='{$username}'");
    if($kiemtra_account->num_rows == 1){
    $login = $kunloc->query("SELECT * FROM `account` WHERE (username ='$username' OR email='$username') AND password ='$password'");
    if($login->num_rows == 1){
        $account = $login->fetch_object();
        $_SESSION['username'] = $account->username;
        $_SESSION['ip'] = $account->ip;
        JSON("Đăng nhập thành công","Chờ chuyển hướng....","success","die","trang-chu");
    }else JSON("Mật Khẩu Không Đúng","Kiểm tra lại mật khẩu của bạn!","error");
   }else JSON("Tài khoản không tồn tại","Hệ thống không nhận dạng được tài khoản này!","error");
  }
}
include_once("../config.php");
if(empty($_POST['username']) || empty($_POST['password'])){
   JSON("Yêu cầu thông tin","Bạn cần điền đầy đủ các trương ở trên để tiến hành đăng nhập","info");
}
$username = strtolower(tachchuoi($_POST['username']));
$password = md5(tachchuoi($_POST['password']));
$Data = new Login();
$Data->username = $username;
$Data->password = $password;
$Data->Start();
?>