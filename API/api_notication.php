<?php
    require_once("../config.php");
    if($_GET) $_POST = $_GET;
    if(isset($_POST['type'])){
        $case = $_POST['type'];
        switch($case){
            /////////////////////////////////////
            case 'get_thongbao':
                $thongbao = $kunloc->query("SELECT * FROM `thongbao` WHERE trangthai = 'show' AND username = '$username' ORDER BY id DESC LIMIT 0,1");
                if($thongbao->num_rows == 1){
                $thongbao = $thongbao->fetch_object();
                $JSON = array(
                    "id" => $thongbao->id,   
                    "title" => 'Thông báo!',
                    "text" => $thongbao->noidung,
                    "type" => 'question',
                  );
                }
               ECHO json_encode($JSON, JSON_UNESCAPED_UNICODE); 
            break;
            /////////////////////////////////////
            case 'update_thongbao':
                $i = intval($_POST['id']);
                $thongbao = $kunloc->query("SELECT * FROM thongbao WHERE id = '$i' AND username = '$username'");
                $thongbao = $thongbao->fetch_object();
                if(isset($thongbao->id) && $thongbao->trangthai == 'show'){
                    $kunloc->query("UPDATE thongbao SET trangthai = 'hide' WHERE id = '{$thongbao->id}' ");
                    $JSON = array(
                    "id" => $thongbao->id,     
                    "success" => $thongbao->username,   
                    "trangthai" => 'hide',
                  );
                }else if($thongbao->trangthai == 'hide'){
                    $JSON = array(
                    "id" => $thongbao->id,     
                    "error" => $thongbao->username,
                  );
                }
               ECHO json_encode($JSON, JSON_UNESCAPED_UNICODE); 
            break;
            /////////////////////////////////////
        }
    }
?>