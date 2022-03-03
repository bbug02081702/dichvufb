<?php
session_start();
require_once("../config.php");
if($_GET) $_POST = $_GET;
if($_POST && isset($_POST['case'])){
    switch($_POST['case']):
      case 'ACTIVE':
          $id = $kunloc->real_escape_string($_POST['id']);
          if(empty($id)) die(json_encode(["type"=>"error","text"=>"ID Không hợp lệ","title"=>""]));
          if($username != $admin) die(json_encode(["type"=>"error","text"=>"Bạn không có quyền","title"=>""]));
          $value = "true";
          $query = $kunloc->query("UPDATE account SET kichhoat = '$value' WHERE id = '$id'");
          if($query) die(json_encode(["type"=>"success","text"=>"Đã $value thành công","title"=>""]));
          else die(json_encode(["type"=>"error","text"=>"Đã $value thất bại","title"=>"ERROR"]));
      break;
      case 'BANNED':
          $id = $kunloc->real_escape_string($_POST['id']);
          if(empty($id)) die(json_encode(["type"=>"error","text"=>"ID Không hợp lệ","title"=>""]));
          if($username != $admin) die(json_encode(["type"=>"error","text"=>"Bạn không có quyền","title"=>""]));
          $value = "disabled";
          $query = $kunloc->query("UPDATE account SET kichhoat = '$value', toida = '0' WHERE id = '$id'");
          if($query) die(json_encode(["type"=>"success","text"=>"Đã $value thành công","title"=>""]));
          else die(json_encode(["type"=>"error","text"=>"Đã $value thất bại","title"=>"ERROR"]));
      break;
      case 'UNACTIVE':
          $id = $kunloc->real_escape_string($_POST['id']);
          if(empty($id)) die(json_encode(["type"=>"error","text"=>"ID Không hợp lệ","title"=>""]));
          if($username != $admin) die(json_encode(["type"=>"error","text"=>"Bạn không có quyền","title"=>""]));
          
          $value = "fail";
          $query = $kunloc->query("UPDATE account SET kichhoat = '$value' WHERE id = '$id'");
          if($query) die(json_encode(["type"=>"success","text"=>"Đã $value thành công","title"=>""]));
          else die(json_encode(["type"=>"error","text"=>"Đã $value thất bại","title"=>"ERROR"]));
      break;
      case 'REMOVE':
          $id = $kunloc->real_escape_string($_POST['id']);
          if(empty($id)) die(json_encode(["type"=>"error","text"=>"ID Không hợp lệ","title"=>""]));
          if($username != $admin) die(json_encode(["type"=>"error","text"=>"Bạn không có quyền","title"=>""]));
          $value = "fail";
          $kiemtra = $kunloc->query("SELECT * FROM account WHERE id = '$id'")->fetch_object();
          $query = $kunloc->query("DELETE FROM account WHERE id = '$id'");
          $kunloc->query("DELETE FROM uploads WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM table_chi_tieu WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM api_thesieure WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM api_momo WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM table_rut_tien WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM table_napthe WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM table_bank WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM table_history WHERE username = '{$kiemtra->username}'");
          $kunloc->query("DELETE FROM table_bill WHERE username = '{$kiemtra->username}'");
          if($query) die(json_encode(["type"=>"success","text"=>"Đã $value thành công","title"=>""]));
          else die(json_encode(["type"=>"error","text"=>"Đã $value thất bại","title"=>"ERROR"]));
      break;
    endswitch;   
}
?>