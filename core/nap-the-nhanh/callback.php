<?php
error_reporting(0);
include("../../config.php");
if($_GET) $_POST = $_GET;
if(isset($_POST['status']) && isset($_POST['thucnhan']) && isset($_POST['content'])){
    $Code = addslashes($_POST['status']);
    $CardValue = addslashes($_POST['thucnhan']);
    $TrxID = addslashes($_POST['content']);
    $kiemtra = $kunloc->query("SELECT * FROM napthe WHERE ma_giao_dich = '$TrxID' ");
    $data = $kiemtra->fetch_object();   
    if($kiemtra->num_rows == 1){
        if($Code == 'success' || $Code == 'Success' || $Code == 'hoantat' || $Code == 'Hoantat'){
            if($data->trangthai != 100){
                $kunloc->query("UPDATE napthe SET trangthai = '$Code' WHERE id = '".$data->id."' ");
                $addmoney = $kunloc->query("UPDATE account SET VND = VND + '$CardValue' WHERE username='".$data->username."' ");
                if($addmoney == 1){
                    $kunloc->query("UPDATE napthe SET trangthai = '100' WHERE id = '".$data->id."' ");
                    $noidung  = "Bạn đã nạp CARD với số tiền: ".format_cash($CardValue)."đ vào tài khoản lúc: ".$data->date;
                    Thongbao($data->username,$noidung);
                    $noidung2 = "".$data->username." vừa được [ADMIN] cộng: ".format_cash($CardValue)."đ bằng phương thức CARD AUTO";
                    NhatkyHd($data->username,$noidung2,'#',0,$CardValue,'CARD');
                    echo $msg = "Đã cộng: ".format_cash($CardValue) ."đ";
                } 
            } 
            echo $msg = 'Thẻ đúng';
        }else{
            $kunloc->query("UPDATE napthe SET trangthai = '$Code' WHERE id = '".$data->id."' ");
            echo $msg = $Code;
        }
    }else{
        echo 'null';
    }
}else{
    echo 'null'; 
}
?>