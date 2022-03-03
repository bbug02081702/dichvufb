<?php 
    if(isset($_SESSION['username'])){
    $kunloc_data = $kunloc->query("SELECT * FROM account WHERE username = '".$_SESSION['username']."'")->fetch_object();
        $id_user = $kunloc_data->id;
        $username = $kunloc_data->username;
        $image = $kunloc_data->avatar;
        $fullname = $kunloc_data->fullname;
        $level = $kunloc_data->level;
        if($level == 'admin'){
           $admin = $username;  
        }else{
           $admin = $admins; 
        }
        if($level == 'admin'){ 
          $level_type = "Quản trị viên";
        }else if($level == 'ctv'){
          $level_type = "Cộng tác viên";
        }else if($level == 'daily'){
          $level_type = "Đại lý";
        }else{
         $level_type = "Khách";
        }
        $chietkhau = $kunloc_data->chietkhau;
        $kichhoat = $kunloc_data->kichhoat;
        if($kichhoat == 'true') $kichhoat_type = 'Đã kích hoạt'; else $kichhoat_type= 'Chưa kích hoạt'; 
        $vnd = $kunloc_data->VND;
        $phone = $kunloc_data->phone;
        $email = $kunloc_data->email;
        $emailuser = $email;
        $accessToken = $kunloc_data->token;
        $created_at = $kunloc_data->created_at;
        $confirm_code = $kunloc_data->confirm_code;
    }
  //////////////////////////////////////////////////
    $setup = $kunloc->query("SELECT * FROM `setting`")->fetch_object();
    $macdinh = $setup->logo;
    $logo = $setup->logo;
    $background = $setup->background;
    $ico = $setup->ico;
    $tieude = $setup->title;
    $content = $setup->content;
    /* MOMO */
    $momo_key = $setup->momo_key;
    $momo_number = $setup->momo_number;
    $momo_name = $setup->momo_name;
    $momo_image = $setup->momo_image;
    /* BANK */
    $bank_image = $setup->bank_image;
    $bank_number = $setup->bank_number;
    $bank_name = $setup->bank_name;
    $bank_type = $setup->bank_type;
    $bank_chi_nhanh = $setup->bank_chi_nhanh;
    $bank_content = $setup->bank_content;
    /* key card */
    $keycard = $setup->card_key;
    $callback = $setup->card_callback;
    $theme_image = "background-image:url($background);height:0 auto; background-position: center;background-repeat: no-repeat;background-size: cover";
  //////////////////////////////////////////////////
?>