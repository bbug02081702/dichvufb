<?php
    if($username && isset($_REQUEST['Home']) || isset($_REQUEST['Order']) || isset($_REQUEST['Info']) || isset($_REQUEST['Admin']) || isset($_REQUEST['Bank'])){
             #=============================
             $Order = $_REQUEST['Order'];
             if($username){
                if($trangthai == 'disabled'){
                    header('Location: disable.html');
                }else{
                switch($Order){
                    #----- ORDER --------
                    case 'tao-dich-vu': 
                        include 'core/order/tao-dich-vu.php'; 
                    break;
                    #----- ORDER --------
                    case 'quan-li': 
                        include 'core/order/quanli.php'; 
                    break;
                    case 'nhat-ky': 
                        include 'core/nhat-ky/index.php'; 
                    break;
                }
            }
            }else{
                header('Location: dang-nhap');
            }
             $Home = $_REQUEST['Home'];
             if($username){
                if($trangthai == 'disabled'){
                    header('Location: disable.html');
                }else{
                switch($Home){
                case 'trang-chu': 
                    include 'system/trang-chu-he-thong.php'; 
                    break;
                case 'bang-gia': 
                    include 'system/bang-gia-dich-vu.php'; 
                    break;  
                #---------------------------
                case 'ticket': 
                    include 'core/ticket/index.php'; 
                    break;
                
                }
            }
            }else{
                header('Location: dang-nhap');
            }
            
            #=============================
            $Info = $_REQUEST['Info'];
            if($username){
                if($trangthai == 'disabled'){
                    header('Location: disable.html');
                }else{
               switch($Info){
                   #Thay đổi thông tin
                   case 'thay-doi-thong-tin': 
                       include 'system/thay-doi-thong-tin.php'; 
                   break;
                   #Thay đổi mật khẩu
                   case 'thay-doi-mat-khau': 
                    include 'system/thay-doi-mat-khau.php'; 
                    break;
                   
               }
            }
           }else{
               header('Location: dang-nhap');
           }
           
          #=============================
          $Admin_ = $_REQUEST['Admin'];
          if($username){
            if($trangthai == 'disabled'){
                header('Location: disable.html');
            }else{
             switch($Admin_){
                 #Quản lí thành viên
                 case 'quan-li-thanh-vien': 
                     include 'core/kunloc/quan-li-thanh-vien.php'; 
                 break;
                 #Cài đặt giao diện
                 case 'cai-dat-giao-dien': 
                    include 'core/kunloc/cai-dat-giao-dien.php'; 
                 break;
                 case 'tao-thong-bao': 
                    include 'core/kunloc/thongbao.php'; 
                 break;
             }
         }
         }else{
             header('Location: dang-nhap');
         }
         #=============================
         $Bank_ = $_REQUEST['Bank'];
         if($username){
           if($trangthai == 'disabled'){
               header('Location: disable.html');
           }else{
            switch($Bank_){
                #Momo
                case 'mo-mo': 
                    include 'core/mo-mo/index.php'; 
                break;
                #thesieure
                case 'thesieure': 
                    include 'core/thesieure/index.php'; 
                break;
                #Bank
                case 'bank': 
                    include 'core/bank/index.php'; 
                 break;
                #Rut tien
                case 'rut-tien': 
                   include 'core/rut-tien/index.php'; 
                break;
                #Rut tien
                case 'chuyen-tien': 
                    include 'core/chuyen-tien/index.php'; 
                 break;
                #Rut tien
                case 'nap-the': 
                    include 'core/nap-the/index.php'; 
                 break;
                #Rut tien
                case 'nap-the-auto': 
                    include 'core/nap-the-nhanh/index.php'; 
                 break;
            }
        }
        }else{
            header('Location: dang-nhap');
        }
    
    }else{
        if(empty($username)){
            session_destroy();
            //header('Location: dang-nhap');
            include 'system/dang-nhap-he-thong.php';
        }else if($trangthai == 'disabled'){
            header('Location: disable.html');
        }else{ 
           include 'system/trang-chu-he-thong.php';
        }
    }
     ?>

<?php require_once("main/foot.php"); ?>