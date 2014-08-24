<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
$query = "SELECT * FROM Product WHERE ID = $id";
$result = mysql_query($query);
if($result){
  $row = mysql_fetch_array($result);
}else{
  echo "<h2>Không tìm thấy sản phẩm nào !</h2>";
  return 0;
}
$name=$row["NAME"];
$description=$row["DESCRIPTION"];		
$quantity=$row["QUANTITY"];
$price=$row["PRICE"];
$guaranty=$row["GUARANTY"];
$dimension=$row["DIMENSION"];
$display_other=$row["DISPLAY_OTHER"];
$thumbnail=$row["THUMBNAIL"];
$offer=$row["OFFER"];		 
$brandid=$row["BRANDID"];
$osid=$row["OSID"];
$displaysize=$row["DISPLAYSIZE"];
$weight=$row["WEIGHT"];		
$design=$row["DESIGN"];		 
$camera=$row['CAMERA'];
$videorecord=$row['VIDEORECORD'];
$sound=$row['SOUND'];
$g2=$row["2G"];		 
$g3=$row["3G"];		 
$cpu=$row["CPU"];	
$edge=$row['EDGE'];
$wifi=$row['WIFI'];
$gps=$row['GPS'];
$bluetooth=$row['BLUETOOTH'];
$radio=$row['RADIO'];
$ext=$row['EXT_MEMORY'];	 
$int=$row["INT_MEMORY"];		 
$network=$row["NETWORK"];		 
$batteryinfo=$row["BATTERYINFO"];
$usb=$row['USB'];
$browser=$row['BROWSER'];	
$camera_other=$row['CAMERA_OTHER'];
$qwerty=$row['QWERTY'];
$messaging=$row["MESSAGING"];
$feature_other=$row['FEATURE_OTHER'];
$java=$row['JAVA'];
function checked($value){
  if($value)
    echo "checked='checked'";
}
 ?>
<div class="top-bar">
<h1>Cập nhật sản phẩm</h1>
</div>
<br />
<form name="add_product" action="?page=product_query&action=update&id=<?echo $id;?>" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin sản phẩm</th>
  </tr>

  <tr>
    <td width="50%">Tên sản phẩm</td>
    <td width="50%">
      <input name="NAME" type="text" value="<?echo $name;?>" size="30" />
    </td>
  </tr>
  <tr>
    <td>Miêu tả sản phẩm</td>
    <td><textarea name="DESCRIPTION" rows="4" cols="38"><?echo $description;?></textarea></td>
  </tr>
    <tr>
    <td>Hình ảnh đại diện</td>
    <td>
      <img src="<?echo $thumbnail;?>" width="100" height="100" alt="<?echo $name;?>" />
      <input name="THUMBNAIL" type="text"  value="<?echo $thumbnail;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>Số lượng</td>
    <td><input name="QUANTITY" type="text" value="<?echo $quantity;?>" size="3" /></td>
  </tr>
  <tr>
    <td>Giá</td>
    <td><input name="PRICE" type="text" value="<?echo $price;?>" size="20" /> (VNĐ) </td>
  </tr>
  <tr>
    <td>Bảo Hành</td>
    <td><input name="GUARANTY" type="text" value="<?echo $guaranty;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>Thông tin khuyến mãi</td>
    <td><textarea name="OFFER" rows="4" cols="38"><?echo $offer;?></textarea></td>
  </tr>
  <tr>
    <th class="full" colspan="2">Thông tin chi tiết</th>
  </tr>
  <tr>
    <td>Hãng sản xuất</td>
    <td><select name="BRANDID">
    <?php
		$query = "SELECT * FROM Brand";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
        if($row['ID'] == $brandid)
          echo "<option value='".$row['ID']."' selected='selected'>".$row['BRANDNAME']."</option>";
        else
          echo "<option value='".$row['ID']."'>".$row['BRANDNAME']."</option>";
		  }
		}
    ?></select>
    </td>
  </tr>
    <tr>
    <td>Mạng</td>
    <td><input name="NETWORK" type="text" value="<?echo $network;?>" size="30"  /></td>
  </tr>
    <tr>
    <td>2G</td>
    <td><input name="2G" type="text" value="<?echo $g2;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>3G</td>
    <td><input name="3G" type="text" value="<?echo $g3;?>" size="30"  /></td>
  </tr>

  <tr>
    <td>Hệ điều hành</td>
    <td><select name="OSID">
    <?php
		$query = "SELECT * FROM OS";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
        if($row['ID'] == $osid)
          echo "<option value='".$row['ID']."' selected='selected'>".$row['OSNAME']."</option>";
        else
          echo "<option value='".$row['ID']."'>".$row['OSNAME']."</option>";
		  }
		}
    ?></select>
    </td>
  </tr>
      <tr>
    <td>CPU</td>
    <td><input name="CPU" type="text" value="<?echo $cpu;?>" size="30"  /></td>
  </tr>	
  <tr>
    <td>Kích thước màn hình</td>
    <td><input name="DISPLAYSIZE" type="text" value="<?echo $displaysize;?>" size="30"  /></td>
  </tr>
    <tr>
    <td>Độ phân giải màn hình</td>
    <td><input name="DIMENSION" type="text" value="<?echo $dimension;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>Khối lượng</td>
    <td><input name="WEIGHT" type="text" value="<?echo $weight;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>Thiết kế</td>
    <td><input name="DESIGN" type="text" value="<?echo $design;?>" size="30"  /></td>
  </tr>
    <tr>
    <td>Thông tin hiển thị khác</td>
    <td><textarea name="DISPLAY_OTHER" rows="4" cols="38"><?echo $display_other;?></textarea></td>
  </tr>
    <tr>
    <th class="full" colspan="2">Tính năng</th>
  </tr>
  <tr>
    <td>Máy ảnh</td>
    <td><input name="CAMERA" type="text" value="<?echo $camera;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>Quay video</td>
    <td><input name="VIDEORECORD" type="checkbox" <?php checked($videorecord);?> value="1"  /><?php checked($videorecord);?></td>
  </tr>
    <tr>
    <td>Thông tin máy ảnh khác</td>
    <td><textarea name="CAMERA_OTHER" rows="4" cols="38"><?echo $camera_other;?></textarea></td>
  </tr>
  <tr>
    <td>Âm thanh</td>
    <td><input name="SOUND" type="text" value="<?echo $sound;?>" size="30"  /></td>
  </tr>
    <tr>
    <td>Bộ nhớ ngoài</td>
    <td><input name="EXT_MEMORY" type="text" value="<?echo $ext;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>Bộ nhớ trong</td>
    <td><input name="INT_MEMORY" type="text" value="<?echo $int;?>" size="30"  /></td>
  </tr>
      <tr>
    <td>Pin</td>
    <td><input name="BATTERYINFO" type="text" value="<?echo $batteryinfo;?>" size="30"  /></td>
  </tr>
   <tr>
    <td>Tin nhắn</td>
    <td><input name="MESSAGING" type="text" value="<?echo $messaging;?>" size="30"  /></td>
  </tr>
  <tr>
    <td>USB</td>
    <td><input name="USB" type="text" value="<?echo $usb;?>" size="30"   /></td>
  </tr>
  <tr>
    <td>Trình duyệt</td>
    <td><input name="BROWSER" type="text" value="<?echo $browser;?>" size="30" /></td>
  </tr>
  <tr>
    <td>EDGE</td>
    <td><input name="EDGE" type="checkbox" <?php checked($edge);?> value="1"  /></td>
  </tr>
  <tr>
    <td>WIFI</td>
    <td><input name="WIFI" type="checkbox" <?php checked($wifi);?> value="1" /></td>
  </tr>
  <tr>
    <td>GPS</td>
    <td><input name="GPS" type="checkbox" <?php checked($gps);?> value="1" /></td>
  </tr>
  <tr>
    <td>BLUETOOTH</td>
    <td><input name="BLUETOOTH" type="checkbox" <?php checked($bluetooth);?> value="1" /></td>
  </tr>
  <tr>
    <td>RADIO</td>
    <td><input name="RADIO"  type="checkbox" <?php checked($radio);?> value="1"  /></td>
  </tr>
  <tr>
    <td>JAVA</td>
    <td><input name="JAVA" type="checkbox" <?php checked($java);?> value="1" /></td>
  </tr>

  <tr>
    <td>Bàn phím QWERTY</td>
    <td><input name="QWERTY"  type="checkbox" <?php checked($qwerty);?> value="1" /></td>
  </tr>
  <tr>
    <td>Các tính năng khác</td>
    <td><textarea name="FEATURE_OTHER" rows="4" cols="38"><?echo $feature_other;?></textarea></td>
  </tr>
  <tr>
    <td colspan="2"><center>
          <input type="hidden" name="update_product" value="updated" />
      <input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
  
</form>
