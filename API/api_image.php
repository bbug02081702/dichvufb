<?php
 error_reporting(0);
 require_once("../config.php");
 foreach($_FILES as $file){
   $name = $file['name'];
   $sizeFile = $file['size'];
   $uploaded_tmp = $file['tmp_name'];
   $info = substr($name, strrpos($name, '.' ) + 1);
   $foldername = md5(rand()).".".$info;
   $dirfolder = "data/$foldername";
   if(empty($sizeFile)){
    echo json_encode(array("error" => "Chưa có ảnh")); 
   }else{
    if((strtolower($info) == "jpg" || strtolower($info) == "jpeg" || strtolower($info) == "png") && getimagesize($uploaded_tmp)){
        if(file_exists("../$dirfolder")){
         $JSON = array(
			      "title" => "",
            "text" => "Đã tải 1 ảnh",
            "type" => "success",
            "url"=> $dirfolder,
            "tmp_name"=> $uploaded_tmp,
            "size" => $sizeFile,
            );
          die(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }else if($sizeFile > 800000000){
          JSON("","File bạn upload không được quá 8MB","error" );
        }else if(move_uploaded_file($uploaded_tmp,"../$dirfolder")){
            $JSON = array(
                "title" => "",
                "text" => "Đã tải 1 ảnh",
                "type" => "success",
                "url"=>"$domain_url/$dirfolder",
                "tmp_name"=> $uploaded_tmp,
                "size" => $sizeFile,
            );
          exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
      }else JSON("","File không hỗ trợ, bạn vui lòng chọn hình ảnh","error" );
   }
}
?> 