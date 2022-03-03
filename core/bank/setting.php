<?php
    require_once("../../config.php");
    if(isset($_POST['type'])){
        $Case = $_POST['type'];
        switch($Case){
            case 'CONFIRM':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                
                $kiemtra = $kunloc->query("SELECT * FROM `table_bank` WHERE id = '$i' ");
                if($kiemtra->num_rows == 1){
                    $kiemtra =  $kiemtra->fetch_object();
                    $UPDATE = $kunloc->query("UPDATE `table_bank` SET trangthai = 'succeess' WHERE id = '{$kiemtra->id}' ");
                    if($UPDATE){
                        $kunloc->query("UPDATE account SET VND = VND + '".$kiemtra->table_price."' WHERE username = '{$kiemtra->username}' ");
                        #---------- Mailer -----------
                        $tieudes = 'Yêu cầu xét duyệt thành công';
                        $message = "Chào, ".$kiemtra->username."<br>
                        Hệ thống đã xác nhận yêu cầu của bạn.<br>
                        Số tiền được thêm vào tài khoản là: ".format_cash($kiemtra->table_price)."đ";
                        $bcc = 'VIETCOMBANK SUPPORT';
                        $getemail = $kunloc->query("SELECT * FROM account WHERE username = '{$kiemtra->username}'")->fetch_object();
                        SendEmail($getemail->email,$tieudes,$message,$bcc);
                        JSON("Thông báo","Đã duyệt thành công","success","exit",true);
                           
                    }else JSON("Thông báo","Không thể duyệt id này", "error");
         
                }else JSON("Thông báo","Giao dịch không tồn tại", "error");

            break;
            #----------------------------------------------------------------
            case 'REMOVE':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                
                $kiemtra = $kunloc->query("SELECT * FROM `table_bank` WHERE id = '$i' ");
                if($kiemtra->num_rows == 1){
                    $kiemtra =  $kiemtra->fetch_object();
                    #$kunloc->query("DELETE FROM `table_bank` WHERE id = '$i'");
                    $UPDATE = $kunloc->query("UPDATE `table_bank` SET trangthai = 'error' WHERE id = '{$kiemtra->id}' ");
                    if($UPDATE){
                        $tieu_de = 'Yêu cầu xét duyệt thất bại';
                        $message = "Chào, ".$kiemtra->username."<br>
                        Hệ thống đã xác nhận yêu cầu của bạn là không hợp lệ.<br>
                        Nếu có thắc mắc, vui lòng tạo yêu cầu hỗ trợ ở góc bên trái Thanh Menu";
                        $bcc = 'VIETCOMBANK SUPPORT';
                        $getemail = $kunloc->query("SELECT * FROM account WHERE username = '{$kiemtra->username}'")->fetch_object();
                        SendEmail($getemail->email,$tieu_de,$message,$bcc);
                        JSON("Thông báo","Đã duyệt thành công","success","exit",true);
                            
                    }else JSON("Thông báo","Không thể duyệt id này", "error");
  
                }else JSON("Thông báo","Giao dịch không tồn tại", "error");
                
            break;
        }
    }else JSON("Thông báo","Bạn không có quyền", "error");
?>