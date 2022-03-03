<?php
    require_once("../../config.php");
    if($_GET) $_POST = $_GET;
    if (!isset($_POST['type']) || !isset($_POST['amount']) || !isset($_POST['serial']) || !isset($_POST['code'])) {
        JSON("Thông báo", "Bạn chưa điền đầy đủ thông tin", "error");
    } else {
        $url = 'https://card24h.com/api/card-auto.php';
        $APIKey = $keycard;
        $TrxID = rand(100000000, 999999999);  //Mã đơn hàng của bạn
        $Network = htmlentities($_POST['type']);
        $CardCode = addslashes($_POST['code']);
        $CardSeri = addslashes($_POST['serial']);
        $CardValue = addslashes($_POST['amount']);
        $URLCallback= $callback;
        /////////// JSON //////////////////
        $dataPost = array();
        $dataPost['type'] = $Network;
        $dataPost['pin'] = $CardCode;
        $dataPost['seri'] = $CardSeri;
        $dataPost['menhgia'] = $CardValue;
        $dataPost['content'] = $TrxID;
        $dataPost['APIKey'] = $APIKey;
        $dataPost['callback'] = $URLCallback;
        $data = http_build_query($dataPost);
        $obj = json_decode(Curl("https://card24h.com/api/card-auto.php?".$data));
        /////////////////////////////
        $kiemtra = $kunloc->query("SELECT * FROM napthe WHERE `serial` = '$CardSeri' AND `code` = '$CardCode' ");
        /////////////////////////////
        if($kiemtra->num_rows == 1) JSON( "Thẻ này đã tồn tại trên hệ thống","Xin vui lòng kiểm tra lại","error");

        else{
        /////////////////////////////   
            if ($obj->data->status == 'success') {
             
             $kunloc->query("INSERT INTO `napthe`(`username`, `telco`, `amount`, `serial`, `code`, `date`, `trangthai`,`ma_giao_dich`) VALUES ('$username','$Network','$CardValue','$CardSeri','$CardCode','$now','0','$TrxID')");
             JSON("Thành công", "Gửi thẻ thành công, đợi duyệt", "success");
               
            } elseif ($obj->data->status == 'error') {
             $error = $obj->data->msg;
             JSON("Thông báo", "Lỗi, hệ thống từ chối thẻ này. $error", "error"); 
            } else {
             $error = $obj->data->msg;
             JSON("Thông báo", "Lỗi, hệ thống từ chối thẻ này. $error", "error"); 
            }
            
        }  
    }
function Curl($url) {
    $head = array(
        "authority: card24h.com",
        "method: GET",
        "cache-control: max-age=0",
        "upgrade-insecure-requests: 1",
        "user-agent: Mozilla/5.0 (Linux; Android 9; Mi A1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/86.0.4240.110 Mobile Safari/537.36",
        "accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
        "sec-fetch-site: none",
        "sec-fetch-mode: navigate",
        "sec-fetch-user: ?1",
        "sec-fetch-dest: document",
        "accept-language: vi-VN,vi;q=0.9,fr-FR;q=0.8,fr;q=0.7,en-US;q=0.6,en;q=0.5",
    );
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => $head,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_RETURNTRANSFER =>  1,
    ));
    $get = curl_exec($ch);
    curl_close($ch);
    return $get;
} 
?>