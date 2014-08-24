<?php
$site_root = $_SERVER['DOCUMENT_ROOT'];
$site_url = "http";
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")
  $site_url .= "s";
$site_url .= '://';
if($_SERVER['SERVER_PORT'] != 80)
  $site_url .= $_SERVER['SERVER_NAME'].$_SERVER['SERVER_PORT'];
else
  $site_url .= $_SERVER['SERVER_NAME'];
$site_url .= "/home/prj";
$site_title = "Nhom 4 - Website ban dien thoai di dong";
$site_email = "admin@c1101"
?>
