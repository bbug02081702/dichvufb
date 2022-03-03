<?php
    require_once("../../config.php");
    if(isset($_POST['type'])){
        $Case = $_POST['type'];
        switch($Case){
            case 'CONFIRM':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $kiemtra = $kunloc->query("SELECT * FROM `table_momo` WHERE id = '$i'");
                if($kiemtra->num_rows == 1){
                    $data = $kiemtra->fetch_object();
                    $DUYET = $kunloc->query("UPDATE `table_momo` SET trangthai = 'success' WHERE id = '{$data->id}' ");
                    if($DUYET){
                     $info = $kunloc->query("SELECT * FROM account WHERE username = '{$data->username}'")->fetch_object(); 
                     $UPDATE = $kunloc->query("UPDATE account SET VND = VND + '{$data->price}' WHERE username = '{$data->username}' ");
                     $noidung  = "Bạn đã nạp MOMO với số tiền: ".format_cash($data->price)."đ vào tài khoản lúc: ".$data->created_at;
                     Thongbao($data->username,$noidung);
                     $noidung2 = "".$data->username." vừa được cộng: ".format_cash($data->price)."đ bằng phương thức MOMO";
                     NhatkyHd($data->username,$noidung2,'','',$data->price,'MOMO');
                     #---------- Mailer -----------
                     $tieu_de = 'Yêu cầu xét duyệt thành công';
                     $message = "Chào, ".$data->username."<br>
                     Hệ thống đã xác nhận yêu cầu của bạn.<br>
                     Số tiền được thêm vào tài khoản là: ".format_cash($data->price)."đ";
                     $bcc = 'MOMO SUPPORT';
                     $getemail = $kunloc->query("SELECT * FROM account WHERE username = '{$data->username}'")->fetch_object();
                     SendEmail($getemail->email,$tieu_de,$message,$bcc);
                     
                     JSON("Thông báo","Đã duyệt thành công","success","exit",true);

                    }else JSON("Thông báo", "Đã duyệt thất bại","error");
                    
                }else JSON("Thông báo","Giao dịch không tồn tại","error");
            break;
            #----------------------------------------------------------------
            case 'REMOVE':
                $i = intval($_POST['id']);
                if($level != 'admin') JSON("Bạn không có quyền","Không thể duyệt id này", "error");
                $DELETE = $kunloc->query("DELETE FROM `table_momo` WHERE id = '$i'");
                if($DELETE) JSON("Thông báo","Đã xóa thành công", "success","exit",true);
                else JSON("Thông báo","Đã xóa thất bại","error");
 
            break;
        }
    }else JSON("Bạn không có quyền","Không thể duyệt id này","error");
?>