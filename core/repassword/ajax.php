<?php
require_once("../../config.php");
if($_GET) $_POST = $_GET;
if(isset($username)) exit(header("Location: $WEBSITE_URL"));
if(isset($_POST['type'])){
    switch($_POST['type']){
    case 'RECOVERY':
        if(empty($_POST['email'])){
            JSON("Yêu cầu email","Bạn chưa điền đầy đủ","question"); 
        }
        $re_email = $_POST['email'];
        $pattern = '#^[a-z][a-z0-9\._]{2,31}@[a-z0-9\-]{3,}(\.[a-z]{2,4}){1,2}$#';
        if(preg_match($pattern, $re_email, $match) != 1){
            JSON("Yêu cầu email","Địa chỉ email không hợp lệ","error");       
        }
       $kiemtra = $kunloc->query("SELECT * FROM account WHERE email = '$re_email'")->fetch_object();
       if(isset($kiemtra->email)){
         #---------- Mailer -----------
         $tieudex = 'Khôi phục tài khoản';
         $noidung = "
         Vui lòng truy cập vào đường dẫn này để khổi phục tài khoản: <a href='$WEBSITE_URL/repassword?confirm=".$kiemtra->confirm_code."'>Click vào đây</a><br>
         Không được chia sẻ CODE với ai<br>- Xin cảm ơn.";
         $bcc = 'RECOVERY';
         SendEmail($kiemtra->email,$tieudex,$noidung,$bcc);
         
         JSON("Đã gửi mã xác thực","Vui lòng vào email kiểm tra","success","exit",true);
                
       }else JSON("Không tìm thấy email","Địa chỉ email không tồn tại","error");
                
    break;
    case 'REPASS':
        if(empty($_POST['newpass']) && empty($_POST['code'])){
            JSON( "Yêu cầu newpass", "Bạn chưa điền pass","question");  
        }
        $newpass = md5(tachchuoi($_POST['newpass']));
        $code = tachchuoi($_POST['code']);
        $kiemtra = $kunloc->query("SELECT * FROM account WHERE confirm_code = '$code'")->fetch_object();
        if(isset($kiemtra->id)){
            $newcode = RandomString(10);
            $UPDATE = $kunloc->query("UPDATE account SET password = '$newpass',confirm_code = '$newcode' WHERE username = '{$kiemtra->username}' ");
            if($UPDATE){
                 $_SESSION['username'] = $kiemtra->username;
                 JSON("Thông báo","Đã đổi mật khẩu", "success", "exit",'trang-chu');
                 
            }else JSON("Thông báo", "Không thể đổi mật khẩu", "error");

        }else JSON("Thông báo","Mã code không tồn tại","error" );

    break;
    }
} 
?>