<?php
session_start();
include("../config.php");
if(empty($username)){
    session_destroy();
    header("location: $domain_url");
}else{
    header("location: $domain_url");
}
?>