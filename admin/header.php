<?php
session_start();
require_once('../includes/mysql.php'); // Connect to the database
include('../includes/global.php');
date_default_timezone_set("Asia/Ho_Chi_Minh");
if(CheckLogin('admin')){
  $welcome_msg = "Xin chào ".$_SESSION['admin_name']."! [ <a href='?page=logout'>Đăng xuất</a> ]<br /><span style='font-weight:normal'>Server time: ".date("G:i d/m/Y")."</span>";
}else{
  header("location:./login.php");
}
$pagename="Home";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <title>Bảng quản trị - <?php echo $pagename;?></title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link  href="css/admin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../scripts/jquery.js" /></script>
    <script type="text/javascript" src="../scripts/javascript.js" /></script>
</head>
<body>
    <div id="wrap">
    <div id="main">
        <div id="header">
            <a href="./index.php" class="logo">Bảng quản trị</a>
            <div id="welcome_msg">
            <?php echo $welcome_msg;?>
            </div>
            <ul id="top-navigation">
                <li><a href="?page=home" class="active">Trang quản trị</a></li>
				<li><a href="?page=frontpage">Trang chính</a></li>
                <li><a href="?page=logout">Đăng xuất</a></li>
            </ul>
        </div>
