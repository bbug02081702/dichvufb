<?php
    require_once("../../config.php");
    header("Content-type:text/javascript;charset:utf-8");
    if($_GET) $_POST  = $_GET;
    if(isset($_POST['token']) && $_POST['token'] !== '') $token = tachchuoi($_POST['token']); 
    else {
     $JSON = ["status"=> 4,"msg"=> "Mã AccessToken không hợp lệ"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));       
    }
    /* Kiểm tra token */
    $kiemtratoken =  $kunloc->query("SELECT * FROM `account` WHERE token = '$token'");
    if($kiemtratoken->num_rows != 1){
     $JSON = ["status"=> 4,"msg"=> "Mã AccessToken không hợp lệ"];
     exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));     
    }
    else{
        $account = $kiemtratoken->fetch_object();
       $vnd = $account->VND;
        $username = $account->username;
    }
 $kiemtra = $kunloc->query("SELECT * FROM `table_bill` WHERE `by_user` ='$username' ORDER BY id ASC");
 if($kiemtra->num_rows < 0) $JSON = [];
 else{
 while ($echo = $kiemtra->fetch_object()) {
     $JSON[data][] = [
        #"id"=> $echo->id,
        "TrixID"=> $echo->TrixID,
        "uid"=> $echo->uid,
        "status"=> $echo->trangthai,
        "price"=> $echo->price,
        "amount"=> $echo->amount,
        "amount_start"=> $echo->amount_start,
        "amount_success"=> $echo->amount_success,
        "note_user"=> $echo->note_user,
        "note_admin"=> $echo->note_admin,
        "created_at"=> $echo->created_at,
     ];
 }
 echo json_encode($JSON,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}

?>