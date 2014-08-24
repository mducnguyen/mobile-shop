<?php
include "header.php"; // Include phần header của trang
?>
<?php
if(isset($_GET['page']) && $_GET['page'] != NULL)
  $mainPage = $_GET['page'];
else
  $mainPage = "home";

switch($mainPage){
  case 'cart':
  case 'view_order':
    $right='right_none.php';
    break;
  default: $right='right.php';
}

$mainPage .= ".php";
if(!@include($mainPage)){ // Include các thành phần giữa trang và kiểm tra xem file đó có tồn tại không
  $_GET['type'] = 'pagenotfound';
  include("error.php"); // Nếu không báo lỗi
}elseif($set_prev_page){
    SetPrevPage_user();
}
if($right != NULL){
  include($right); // Cột phải của trang
}
include "footer.php"; // Include phần footer của trang
?>
