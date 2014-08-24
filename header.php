<?php
session_start();
require_once('./includes/mysql.php'); // Connect to the database
include('./includes/global.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?echo $site_title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="stylesheet.css" type="text/css" />
<link rel="stylesheet" href="./scripts/coin-slider-styles.css" type="text/css" />
<link rel="stylesheet" href="./scripts/jquery.autocomplete.css" type="text/css" />
<script type="text/javascript" src="./scripts/jquery.js"></script>
<script type="text/javascript" src="./scripts/javascript.js"></script>
<script type="text/javascript" src="./scripts/jquery.autocomplete.min.js"></script>

</head>
<body>
<div id="wrap">
  <div id="header">
    <a href="<?echo $site_url?>"><h1 id="logo">Nhóm 4</h1></a>
    <h2 id="slogan">Website bán điện thoại di động trực tuyến</h2>
    <div id="searchform">

    </div>
  </div>
  <?php
    function checkCurrentPage($page){
      if(!isset($_GET['page']) || $_GET['page']==NULL && basename($_SERVER['PHP_SELF']) == "index.php")
        $_GET['page'] = 'home';
      foreach($page as $pagename)
        if($_GET['page'] == $pagename)
          echo " id=\"current\" ";
    }
  ?>
  <div id="menu">
    <ul>
      <li <?checkCurrentPage(array("home"));?> ><a href="./index.php"><span>Trang chủ</span></a></li>
      <li <?checkCurrentPage(array("products","product_search"));?> ><a href="?page=products"><span>Sản phẩm</span></a></li>
      <li <?checkCurrentPage(array("compare"));?> ><a href="?page=compare"><span>So sánh</span></a></li>
      <li <?checkCurrentPage(array("news","view_news"));?> ><a href="?page=news"><span>Tin tức</span></a></li>
      <li <?checkCurrentPage(array("contact"));?> ><a href="?page=contact"><span>Liên hệ</span></a></li>
      <li <?checkCurrentPage(array("about"));?> ><a href="?page=about"><span>Về chúng tôi</span></a></li>
    </ul>
  </div>
  <div id="content-wrap">
    <div class="block" style="text-align: right;">
        <?
        $cart = array();
        if(isset($_SESSION['cart']))
          $cart = $_SESSION['cart'];
        $total = 0;
        foreach($cart as $product){
          $total += $product['unitprice']*$product['quantity'];
        }
        $total  = number_format($total);
        echo "Bạn có ".count($cart)." sản phẩm nào trong <a href='?page=cart'>giỏ hàng</a> <br />";
        echo "Tổng số tiền: $total (VNĐ)<br />";
        echo "<a href='?page=cart'>[ Xem giỏ hàng ]</a>";
      ?>  
    </div>
<?php
if(CheckLogin('customer')){
  echo "<div class='block' style='text-align:right;'>";
  echo "Xin chào ".$_SESSION['name']."! [ <a href='?page=account'>Tài khoản</a> ] [ <a href='?page=logout'>Đăng xuất</a> ] <br />";
  echo "</div>";
}else{
?>
  <form name="login" action="?page=login" method="POST" style="text-align: right;">
	
  Xin chào! Bạn chưa đăng nhập:
 <input type="text" name="username" size="15" value="Tên đăng nhập" onblur="if(this.value==''){this.value='Tên đăng nhập'; $(this).attr('id','username_blur')}" onfocus="this.value='';$(this).attr('id','username')" id="username" />
 <input type="password" name="password" value="Mật khẩu" size="15" onblur="if(this.value==''){this.value='Mật khẩu'; $(this).attr('id','pass_blur')}" onfocus="this.value='';$(this).attr('id','pass')" id="pass" />
  <input type="hidden" name="login" value="logged_in" />
 
  <input type="submit" name="btnLogin" value="Đăng nhập"/>
  <br />
 [ <a href="?page=register">Đăng ký</a> ]
 [ <a href="?page=forgotpass">Quên mật khẩu</a> ]
  </form>
<?
}

if(isset($_GET['page']) && $_GET['page'] != NULL)
  $mainPage = $_GET['page'];
    else
  $mainPage = "home";

  switch($mainPage){
    case 'cart':
    case 'view_order':
    $main_style='width:100%';
    break;
  default: $main_style='';
  }
echo "<div id='main' style='$main_style'>";
?>
