<?php
    require_once("../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['type'])){
        $case = $_POST['type'];
        switch($case){
            case 'get_money':
                /*$payment = $kunloc->query("SELECT * FROM `api_momo` WHERE trangthai = 'fail'");
                while($data = $payment->fetch_object()){
                   $account = $kunloc->query("SELECT * FROM account WHERE username = '".$data->username."'");
                   if($kiemtra->num_rows == 1){
                      $account = $account->fetch_object();
                      $congtien = $kunloc->query(
                        "UPDATE account 
                            SET 
                            VND = VND + '".intval($data->price)."'
                            WHERE 
                            username = '".$getinfo->username."' 
                        ");
                        $update_momo =  $kunloc->query(
                        "UPDATE `api_momo` 
                            SET 
                            trangthai = 'success'
                            WHERE 
                            TrixID = '".$data->TrixID."'
                    ");
                     $noidung  = "Bạn đã nạp MOMO với số tiền: ".format_cash($data->price)."đ vào tài khoản lúc: ".date("H:i:s d/m/Y",$data->created_at);
                     Thongbao($account->username,$noidung);
                     $noidung2 = "".$account->username." vừa được [ADMIN] cộng: ".format_cash($data->price)."đ bằng phương thức MOMO";
                     NhatkyVnd($account->username,$noidung2,$account->VND,$data->VND,($account->VND+$data->price));
                     NhatkyHd($account->username,$noidung2,'','',$data->price,'MOMO'); 
                   }
                   
                }
                $payment2 = $kunloc->query("SELECT * FROM `api_thesieure` WHERE trangthai = 'fail'");
                while($data = $payment2->fetch_object()){
                   $account = $kunloc->query("SELECT * FROM account WHERE username = '".$data->username."'");
                   if($kiemtra->num_rows == 1){
                      $account = $account->fetch_object();
                      $congtien = $kunloc->query(
                        "UPDATE account 
                            SET 
                            VND = VND + '".$data->price."'
                            WHERE 
                            username = '".$account->username."' 
                        ");
                        $update_momo =  $kunloc->query(
                        "UPDATE `api_thesieure` 
                            SET 
                            trangthai = 'success'
                            WHERE 
                            TrixID = '".$data->TrixID."'
                    ");
                    $noidung  = "Bạn đã nạp THESIEURE với số tiền: ".format_cash($data->price)."đ vào tài khoản lúc: ".$data->date;
                     Thongbao($account->username,$noidung);
                     $noidung2 = "".$account->username." vừa được [ADMIN] cộng: ".format_cash($data->price)."đ bằng phương thức THESIEURE";
                     NhatkyVnd($account->username,$noidung2,$account->VND,$data->VND,($account->VND+$data->price));
                     NhatkyHd($account->username,$noidung2,'','',$data->price,'THESIEURE'); 
                   }
                   
               }*/
              #----------------------
              $tien = $kunloc->query("SELECT VND FROM account WHERE username = '$username'")->fetch_object();
              $JSON = array("vnd" => number_format($tien->VND)); 
              die(json_encode($JSON, JSON_UNESCAPED_UNICODE));
            break;
        }
    }
    #-----------------------
?>
