<?php 
include("../config.php");
$CURL = new Momo();
$CURL->kunloc = $kunloc;
$CURL->momo_key = $momo_key;
ECHO $CURL->Kiemtra();
Class Momo {
    public $kunloc;
    public $momo_key;
    public function Kiemtra(){
        global $kunloc,$momo_key;
        $momo = json_decode($this->Apimomo("https://api.web2m.com/historyapimomo/".$momo_key));
        if($momo->errorDesc) exit($momo->errorDesc);
        foreach($momo->momoMsg->tranList as $obj){
            if(!$obj->ownerNumber){
               $kiemtra = $kunloc->query("SELECT * FROM `api_momo` WHERE TrixID = '".$obj->tranId."'");
               if($kiemtra->num_rows != 1){
                    $user = explode("naptien ",$obj->comment)[1];
                    $kiemtraccount = $kunloc->query("SELECT * FROM account WHERE username = '$user'");
                    if($kiemtraccount->num_rows == 1){
                    if($obj->comment != 'null') $noidung = $obj->comment;
                    else $noidung = 'Trống';
                    $INSERT = $kunloc->query("INSERT INTO `api_momo`(`username`, `name`, `TrixID`, `content`, `price`, `number`, `created`, `trangthai`) 
                    VALUES ('$user',
                            '".$obj->partnerName."',
                            '".$obj->tranId."',
                            '$noidung',
                            '".$obj->amount."',
                            '".$obj->partnerId."',
                            '".$obj->lastUpdate."',
                            'success')");
                    if($INSERT){
                     $kiemtraccount->fetch_object();
                     $kunloc->query("UPDATE account SET VND = VND + '".intval($sotien)."' WHERE username = '$user'");  
                     Lichsu($username,"NẠP MOMO thành công", $kiemtraccount->VND , intval($sotien));
                      /* Send email cho người dùng */ 
                     $tieudes = 'Nạp tiền MOMO thành công';
                     $message = "Chào, ".$kiemtraccount->username."<br>
                     Hệ thống đã xác nhận yêu cầu của bạn.<br>
                     Số tiền được thêm vào tài khoản là: ".format_cash($obj->amount)."đ";
                     $bcc = 'MOMO SUPPORT';
                     SendEmail($kiemtraccount->email,$tieudes,$message,$bcc);    
                    }    
                  }
               }
               $JSON[] = [
                     "TrixId" => $obj->tranId,
                     "phone" => $obj->partnerId,
                      "phonenhan" => $obj->user,
                      "name" => $obj->partnerName,
                      "sotien" => $obj->amount,
                      "content" => $obj->comment,
                      "statusCode" => $obj->status,
                      "status" => $obj->desc,
                      "date" => date("d-m-Y H:i:s",$obj->lastUpdate),
                ];
 
            }
        }
        echo(json_encode($JSON,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));

    }
    public function Apimomo($url) 
    {
    $head = array(
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
}
?>
