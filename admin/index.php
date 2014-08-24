<?php
include "header.php"; // Include phần header của trang
?>
<?php
if(isset($_GET['page']))
  $mainPage = $_GET['page'];
else
  $mainPage = "home";
$forbidPage = array();
$left='left.php'; $right='right.php';
$mainPage .= ".php";
include($left); // Cột trái của trang
if(!@include($mainPage)){ // Include các thành phần giữa trang và kiểm tra xem file đó có tồn tại không
  $_GET['type'] = 'pagenotfound';
  include("error.php"); // Nếu không báo lỗi
}elseif($set_prev_page){
  SetPrevPage_admin();
}
include($right); // Cột phải của trang
include "footer.php"; // Include phần footer của trang
