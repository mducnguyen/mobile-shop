<?php
include("configuration.php");
date_default_timezone_set("Asia/Ho_Chi_Minh");
$cities = array("Hà Nội","Hải Phòng", "Đà Nẵng", "TP Hồ Chí Minh"); sort($cities);
$set_prev_page = 1;

function CheckLogin($user){ // Check if user is logged in
  if($user == "customer")
    $var = 'username';
  else if($user == "admin")
    $var = 'admin_username';
  else
    return 0;
  if(isset($_SESSION[$var]) && $_SESSION[$var] != NULL) 
    $status = 1;
  else
    $status = 0;
  return $status;
}

// Generate Current Page URL
function GetCurrentPage(){
  $pageURL = "http";
  if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on")
    $pageURL .= "s";
  $pageURL .= '://';
  if($_SERVER['SERVER_PORT'] != 80)
    $pageURL .= $_SERVER['SERVER_NAME'].$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
  else
    $pageURL .= $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  return $pageURL;
}

function SetPrevPage_user(){ // Save current page for later redirection
  $_SESSION['prevPage_user'] = GetCurrentPage();
}

function SetPrevPage_admin(){ // Save current page for later redirection
  $_SESSION['prevPage_admin'] = GetCurrentPage();
}

function returnPage_user(){ // Function for redirecting to previously visited page
  if(!isset($_SESSION['prevPage_user']) || $_SESSION['prevPage_user'] == GetCurrentPage())
    $_SESSION['prevPage_user'] = "./index.php";
  header("location:".$_SESSION['prevPage_user']);
}

function returnPage_admin(){ // Function for redirecting to previously visited page
  if(!isset($_SESSION['prevPage_admin']))
    $_SESSION['prevPage_admin'] = "./index.php";
  header("location:".$_SESSION['prevPage_admin']);
}

function CheckPermission($manage){
  if(!isset($_SESSION['admin_username']) || $_SESSION['admin_username'] == NULL)
    return 0;
  return $_SESSION[$manage];
}

function Paging($table,$item_per_page=10,$query=0){
  $data = array();
  if(!$query)
    $query = "SELECT * FROM $table";

  $result = mysql_query($query);
  $total = mysql_num_rows($result); // Total number of rows/items found in database
  $pagenum = ceil($total/$item_per_page); // Number of pages
  if(!isset($_GET['pagenum']) || $_GET['pagenum'] == NULL)
    $currentpage = 1;
  else
    $currentpage = $_GET['pagenum'];
  if($currentpage > $pagenum)
    $currentpage = $pagenum;
  else if($currentpage < 1)
    $currentpage = 1;
  $start = ($currentpage-1)*$item_per_page;
  $query .= " LIMIT $start,$item_per_page";
  // --- Next and Back button
  $btndisable = ($currentpage >= $pagenum || $currentpage < 1)?'disabled':'';
  //$nextbtn = "<input type='button' $btndisable value='Tiếp' onclick=\"window.location.href='?page=".$_GET['page']."&pagenum=".($currentpage+1)."&item=$item_per_page'\" />";
  $nextbtn = "<input type='button' class='button' $btndisable value='Tiếp' onclick=\"window.location.href=param_replace('pagenum',".($currentpage+1).")\" />";
  $btndisable = ($currentpage <= 1 || $currentpage > $pagenum)?'disabled':'';
  //$backbtn = "<input type='button' $btndisable value='Lùi' onclick=\"window.location.href='?page=".$_GET['page']."&pagenum=".($currentpage-1)."&item=$item_per_page'\" />";
  $backbtn = "<input type='button' class='button' $btndisable value='Lùi' onclick=\"window.location.href=param_replace('pagenum',".($currentpage-1).")\" />";
  // ------------------------

  $data['result'] = mysql_query($query);
  $data['count'] = mysql_num_rows($data['result']);
  $data['pagenum'] = $pagenum;
  $data['nextbtn'] = $nextbtn;  
  $data['backbtn'] = $backbtn;
  $data['currentpage'] = $currentpage;
  $data['js_pagejump'] = "var pagenum=document.getElementById('pagejump').value;window.location.href=param_replace('pagenum',pagenum); return false;";
  $data['js_itemperpage'] = "var item_per_page = this.value;window.location.href=param_replace('item',item_per_page)";
  return $data;
}

function top_item($table,$order_field,$ordertype="DESC",$limit=5,$query=0){
  $item = array();

  if($query == "")
    $query = "SELECT * FROM $table";
  $query .= " ORDER BY $order_field $ordertype LIMIT $limit";
  $result = mysql_query($query);
  if(!$result || mysql_num_rows($result) == 0)
    return $item;
  while($row = mysql_fetch_array($result)){
    $item[] = $row;
  }
  return $item;
}

function checkfeature($boolean){
  $img = isset($boolean) && $boolean ? 'tick.png':'cross.png';
  return $img;
}

function maketable($phonenum=2){
  $phone = array();
  for($i = 0; $i < $phonenum; ++$i){
    $phonename = isset($_SESSION['phone_compare'][$i+1])?$_SESSION['phone_compare'][$i+1]:"";
    $query = "SELECT * FROM Product WHERE NAME='$phonename'";
    $result = mysql_query($query);
    if(!$result || mysql_num_rows($result) == 0){
      continue;
    }
  $row = mysql_fetch_array($result);
  // Put the information of the phones into one array
  $phone['id'][] = $row['ID'];
  $phone['name'][] = $row["NAME"];
  $phone['description'][] = $row["DESCRIPTION"];		
  $phone['quantity'][] = $row["QUANTITY"];
 	$phone['price'][] = $row["PRICE"];
	$phone['guaranty'][] = $row["GUARANTY"];
  $phone['dimension'][] = $row["DIMENSION"];
  $phone['display_other'][] = $row["DISPLAY_OTHER"];
  $phone['thumbnail'][] = $row["THUMBNAIL"];
  $phone['offer'][] = $row["OFFER"];		 
	$phone['brandid'][] = $row["BRAND_ID"];
  $phone['osid'][] = $row["OS_ID"];
  $phone['displaysize'][] = $row["DISPLAYSIZE"];
  $phone['weight'][] = $row["WEIGHT"];		
  $phone['design'][] = $row["DESIGN"];		 
	$phone['camera'][] = $row['CAMERA'];
	$phone['videorecord'][] = $row['VIDEORECORD'];
	$phone['sound'][] = $row['SOUND'];
  $phone['2g'][] = $row["2G"];		 
  $phone['3g'][] = $row["3G"];		 
  $phone['cpu'][] = $row["CPU"];	
	$phone['edge'][] = $row['EDGE'];
	$phone['wifi'][] = $row['WIFI'];
	$phone['gps'][] = $row['GPS'];
	$phone['bluetooth'][] = $row['BLUETOOTH'];
	$phone['radio'][] = $row['RADIO'];
	$phone['ext'][] = $row['EXT_MEMORY'];	 
  $phone['int'][] = $row["INT_MEMORY"];		 
  $phone['network'][] = $row["NETWORK"];		 
	$phone['batteryinfo'][] = $row["BATTERYINFO"];
	$phone['usb'][] = $row['USB'];
	$phone['browser'][] = $row['BROWSER'];	
	$phone['camera_other'][] = $row['CAMERA_OTHER'];
	$phone['qwerty'][] = $row['QWERTY'];
  $phone['messaging'][] = $row["MESSAGING"];
  $phone['feature_other'][] = $row['FEATURE_OTHER'];
  $phone['java'][] = $row['JAVA'];
  } ?>
      <table id="compare_table">
        <tr>
          <th colspan="3">Bảng so sánh</th>
        </tr>
        <tr>
          <td class="property" >Tên</td>
          <?for($i=0;$i<$phonenum;++$i){
              $name = isset($phone['name'][$i])?$phone['name'][$i]:"";
              $id =  isset($phone['id'][$i])?$phone['id'][$i]:"";
              echo "<td class='info' style='text-align:center; font-weight:bold;'><a href='?page=product_detail&id=$id'>$name</a></td>";
           }?>
        </tr>
        <tr>
          <td class="property">Hình ảnh</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = isset($phone['thumbnail'][$i])?$phone['thumbnail'][$i]:"";
            echo "<td class='info' style='text-align:center'>
            <img src='$img' width='200' />
            </td>";
           }?>
        </tr>
        <tr><th colspan='3'>Thông tin sản phẩm</th></tr>
        <tr>
          <td class="property">Miêu tả</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['description'][$i])?$phone['description'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Số lượng</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['quantity'][$i])?$phone['quantity'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Giá</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['price'][$i])?$phone['price'][$i]:"";
            echo "<td class='info'>".@number_format($value)." VNĐ</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Khuyến mãi</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['offer'][$i])?$phone['offer'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
       <tr>
          <td class="property">Bảo hành</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['guaranty'][$i])?$phone['guaranty'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>

        <tr><th colspan='3'>Thông tin chi tiết</th></tr>
         <tr>
          <td class="property">Hãng sản xuất</td>
          <?for($i=0;$i<$phonenum;++$i){
            $brandid = isset($phone['brandid'][$i])?$phone['brandid'][$i]:"";
            $query = "SELECT * FROM `Brand` WHERE `ID`=$brandid";
            $result = mysql_query($query);
            $row = @mysql_fetch_array($result);
            $brandname = $row['BRANDNAME'];
            echo "<td class='info'>$brandname</td>";
           }?>
        </tr>
        <tr><td class="property">Mạng</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['network'][$i])?$phone['network'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">2G</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['2g'][$i])?$phone['2g'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">3G</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['3g'][$i])?$phone['3g'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Hệ điều hành</td>
          <?for($i=0;$i<$phonenum;++$i){
            $osid = isset($phone['osid'][$i])?$phone['osid'][$i]:"";
            $query = "SELECT * FROM `OS` WHERE `ID`=$osid";
            $result = mysql_query($query);
            $row = @mysql_fetch_array($result);
            $osname = $row['OSNAME'];
            echo "<td class='info'>$osname</td>";
           }?>
        </tr>
         <tr><td class="property">CPU</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['cpu'][$i])?$phone['cpu'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
       <tr>
          <td class="property">Kích thước màn hình</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['displaysize'][$i])?$phone['displaysize'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>

        <tr>
          <td class="property">Độ phân giải màn hình</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['dimension'][$i])?$phone['dimension'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>

                 <tr>
          <td class="property">Khối lượng</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['weight'][$i])?$phone['weight'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Thiết kế</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['design'][$i])?$phone['design'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Hiển thị</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['display_other'][$i])?$phone['display_other'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><th colspan='3'>Tính năng</th></tr>
        <tr>
          <td class="property">Máy ảnh</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['camera'][$i])?$phone['camera'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Quay video</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['videorecord'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Thông tin máy ảnh khác</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['camera_other'][$i])?$phone['camera_other'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Âm thanh</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['sound'][$i])?$phone['sound'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Bộ nhớ ngoài</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['ext'][$i])?$phone['ext'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Bộ nhớ trong</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['int'][$i])?$phone['int'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
                <tr><td class="property">EDGE</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['edge'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">WIFI</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['wifi'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">GPS</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['gps'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Bluetooth</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['bluetooth'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Đài FM</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['radio'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">USB</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['usb'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Trình duyệt</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['browser'][$i])?$phone['browser'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        
        <tr><td class="property">Nhắn tin</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['messaging'][$i])?$phone['messaging'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Java</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['java'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Bàn phím QWERTY</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['qwerty'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Tính năng khác</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['feature_other'][$i])?$phone['feature_other'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Pin</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['batteryinfo'][$i])?$phone['batteryinfo'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
      </table>
      <br />
      <?
    }

function show_product_info($id){
  $phonenum=1;
  $phone = array();
  for($i = 0; $i < $phonenum; ++$i){
    $query = "SELECT * FROM Product WHERE ID='$id'";
    $result = mysql_query($query);
    if(!$result || mysql_num_rows($result) == 0){
      continue;
    }
  $row = mysql_fetch_array($result);
  // Put the information of the phones into one array
  $views = $row['VIEWS'];
  $phone['name'][] = $row["NAME"];
  $phone['description'][] = $row["DESCRIPTION"];		
  $phone['quantity'][] = $row["QUANTITY"];
 	$phone['price'][] = $row["PRICE"];
	$phone['guaranty'][] = $row["GUARANTY"];
  $phone['dimension'][] = $row["DIMENSION"];
  $phone['display_other'][] = $row["DISPLAY_OTHER"];
  $phone['thumbnail'][] = $row["THUMBNAIL"];
  $phone['offer'][] = $row["OFFER"];		 
	$phone['brandid'][] = $row["BRAND_ID"];
  $phone['osid'][] = $row["OS_ID"];
  $phone['displaysize'][] = $row["DISPLAYSIZE"];
  $phone['weight'][] = $row["WEIGHT"];		
  $phone['design'][] = $row["DESIGN"];		 
	$phone['camera'][] = $row['CAMERA'];
	$phone['videorecord'][] = $row['VIDEORECORD'];
	$phone['sound'][] = $row['SOUND'];
  $phone['2g'][] = $row["2G"];		 
  $phone['3g'][] = $row["3G"];		 
  $phone['cpu'][] = $row["CPU"];	
	$phone['edge'][] = $row['EDGE'];
	$phone['wifi'][] = $row['WIFI'];
	$phone['gps'][] = $row['GPS'];
	$phone['bluetooth'][] = $row['BLUETOOTH'];
	$phone['radio'][] = $row['RADIO'];
	$phone['ext'][] = $row['EXT_MEMORY'];	 
  $phone['int'][] = $row["INT_MEMORY"];		 
  $phone['network'][] = $row["NETWORK"];		 
	$phone['batteryinfo'][] = $row["BATTERYINFO"];
	$phone['usb'][] = $row['USB'];
	$phone['browser'][] = $row['BROWSER'];	
	$phone['camera_other'][] = $row['CAMERA_OTHER'];
	$phone['qwerty'][] = $row['QWERTY'];
  $phone['messaging'][] = $row["MESSAGING"];
  $phone['feature_other'][] = $row['FEATURE_OTHER'];
  $phone['java'][] = $row['JAVA'];
  } ?>
   <h1><?echo $phone['name'][0]."<span style='color:#aaa'> ($views views)</span>";?></h1>
      <table id="compare_table">

        <tr>
          <td class="property" style='width: 30%'>Tên</td>
          <?for($i=0;$i<$phonenum;++$i){
              $name = isset($phone['name'][$i])?$phone['name'][$i]:"";
              echo "<td class='info' style='text-align:center; font-weight:bold;'>$name</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Hình ảnh</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = isset($phone['thumbnail'][$i])?$phone['thumbnail'][$i]:"";
            echo "<td class='info' style='text-align:center'>
            <img src='$img' width='200' /><br />";
       
            add2cart($id);
                echo " </td>";
           }?>
        </tr>
        <tr><th colspan='3'>Thông tin sản phẩm</th></tr>
        <tr>
          <td class="property">Miêu tả</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['description'][$i])?$phone['description'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Số lượng</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['quantity'][$i])?$phone['quantity'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Giá</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['price'][$i])?$phone['price'][$i]:"";
            echo "<td class='info'>".@number_format($value)." VNĐ</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Khuyến mãi</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['offer'][$i])?$phone['offer'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
       <tr>
          <td class="property">Bảo hành</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['guaranty'][$i])?$phone['guaranty'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>

        <tr><th colspan='3'>Thông tin chi tiết</th></tr>
         <tr>
          <td class="property">Hãng sản xuất</td>
          <?for($i=0;$i<$phonenum;++$i){
            $brandid = isset($phone['brandid'][$i])?$phone['brandid'][$i]:"";
            $query = "SELECT * FROM `Brand` WHERE `ID`=$brandid";
            $result = mysql_query($query);
            $row = @mysql_fetch_array($result);
            $brandname = $row['BRANDNAME'];
            echo "<td class='info'>$brandname</td>";
           }?>
        </tr>
        <tr><td class="property">Mạng</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['network'][$i])?$phone['network'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">2G</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['2g'][$i])?$phone['2g'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">3G</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['3g'][$i])?$phone['3g'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Hệ điều hành</td>
          <?for($i=0;$i<$phonenum;++$i){
            $osid = isset($phone['osid'][$i])?$phone['osid'][$i]:"";
            $query = "SELECT * FROM `OS` WHERE `ID`=$osid";
            $result = mysql_query($query);
            $row = @mysql_fetch_array($result);
            $osname = $row['OSNAME'];
            echo "<td class='info'>$osname</td>";
           }?>
        </tr>
         <tr><td class="property">CPU</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['cpu'][$i])?$phone['cpu'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
       <tr>
          <td class="property">Kích thước màn hình</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['displaysize'][$i])?$phone['displaysize'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>

        <tr>
          <td class="property">Độ phân giải màn hình</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['dimension'][$i])?$phone['dimension'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>

                 <tr>
          <td class="property">Khối lượng</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['weight'][$i])?$phone['weight'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Thiết kế</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['design'][$i])?$phone['design'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr>
          <td class="property">Hiển thị</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['display_other'][$i])?$phone['display_other'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><th colspan='3'>Tính năng</th></tr>
        <tr>
          <td class="property">Máy ảnh</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['camera'][$i])?$phone['camera'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Quay video</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['videorecord'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Thông tin máy ảnh khác</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['camera_other'][$i])?$phone['camera_other'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Âm thanh</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['sound'][$i])?$phone['sound'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Bộ nhớ ngoài</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['ext'][$i])?$phone['ext'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Bộ nhớ trong</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['int'][$i])?$phone['int'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
                <tr><td class="property">EDGE</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['edge'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">WIFI</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['wifi'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">GPS</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['gps'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Bluetooth</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['bluetooth'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Đài FM</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['radio'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">USB</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['usb'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Trình duyệt</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['browser'][$i])?$phone['browser'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        
        <tr><td class="property">Nhắn tin</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['messaging'][$i])?$phone['messaging'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Java</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['java'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Bàn phím QWERTY</td>
          <?for($i=0;$i<$phonenum;++$i){
            $img = @checkfeature($phone['qwerty'][$i]);
            echo "<td><img src='./images/$img' style='border:0px' /></td>";
           }?>
        </tr>
        <tr><td class="property">Tính năng khác</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['feature_other'][$i])?$phone['feature_other'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
        <tr><td class="property">Pin</td>
          <?for($i=0;$i<$phonenum;++$i){
            $value = isset($phone['batteryinfo'][$i])?$phone['batteryinfo'][$i]:"";
            echo "<td class='info'>$value</td>";
           }?>
        </tr>
      </table>
      <br />
      <?
    }

function email_validate($email) {
  // First, we check that there's one @ symbol, and that the lengths are right
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
     if (!ereg("^(([A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~-][A-Za-z0-9!#$%&amp;'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
      return false;
    }
  }
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}

function logout_user(){
  unset($_SESSION['username']);
  unset($_SESSION['user_id']);
  unset($_SESSION['name']);
}

function productInCart($id){
  if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $key => $val){
      if($id == $key) 
        return true;
    }
  }else{
    return false;
  }
  return false;
}

function add2cart($id){
  $query = "SELECT QUANTITY FROM Product WHERE ID=$id";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  $quantity = $row['QUANTITY'];
  if($quantity < 1){
    echo "<span style='color:red'>Hết hàng</span><br />";
    return 0;
  }
  if(productInCart($id)){
    echo "<span style='color:red'>Đã có trong giỏ hàng</span><br />";
    echo "<a href='?page=cart_query&action=add&id=$id'>[ Lấy thêm ]</a>"; 
  }else{
    echo "<a href='?page=cart_query&action=add&id=$id'>[ Thêm vào giỏ hàng ]</a>"; 
  }
}
?>
