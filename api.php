<?php
require_once("config.php");
header("Content-type:text/javascript;charset:utf-8");
if($_GET) $_POST = $_GET;
if($_POST['case']){
    switch($_POST['case']){
        case 'SERVICE':
        $table_service = $kunloc->query("SELECT * FROM `table_service`");
        while($echo = $table_service->fetch_object()){
            $JSON[data][] = [
                "id"=> $echo->id,
                "service"=> $echo->service,
                "slug"=> $echo->slug,
                "content"=> $echo->content,
                "banner"=> $echo->banner,
                "trangthai"=> $echo->trangthai,
            ];
        }
        exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )); 
        break;
        case 'MENU':
            $table_service = $kunloc->query("SELECT * FROM `table_service_menu`");
            while($echo = $table_service->fetch_object()){
                $JSON[data][] = [
                    "id"=> $echo->id,
                    "service"=> $echo->service,
                    "type"=> $echo->type,
                    "slug"=> $echo->slug,
                    "content"=> $echo->content,
                    "banner"=> $echo->banner,
                    "trangthai"=> $echo->trangthai,
                ];
            }
            exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )); 
         break;
         case 'SERVER':
            $table_service = $kunloc->query("SELECT * FROM `table_service_server`");
            while($echo = $table_service->fetch_object()){
                $JSON[data][] = [
                    "id"=> $echo->id,
                    "server"=> $echo->server,
                    "type"=> $echo->type,
                    "slug"=> $echo->slug,
                    "price_default"=> $echo->price_default,
                    "price_daily"=> $echo->price_daily,
                    "price_ctv"=> $echo->price_ctv,
                    "amount_min"=> $echo->amount_min,
                    "amount_max"=> $echo->amount_max,
                    "content"=> $echo->content,
                    "trangthai"=> $echo->trangthai,
                ];
            }
            exit(json_encode($JSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES )); 
          break;
          default:
          exit('');
          break;
    }
}