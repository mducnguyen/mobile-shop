<div class="top-bar">
                    <h1>Thêm sản phẩm</h1>
</div>
<br />
<form name="add_product" action="?page=product_query&action=add" method="POST"  enctype="multipart/form-data" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin sản phẩm</th>
  </tr>

  <tr>
    <td width="50%">Tên sản phẩm</td>
    <td width="50%">
      <input name="NAME" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Miêu tả sản phẩm</td>
    <td><textarea name="DESCRIPTION" rows="4" cols="38"></textarea></td>
  </tr>
    <tr>
    <td>Hình ảnh đại diện</td>
     <td> 
      <input name="THUMBNAIL" type="file" size="10" /> 
      <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
    </td>
  </tr>
  <tr>
    <td>Số lượng</td>
    <td><input name="QUANTITY" type="text" size="3" /></td>
  </tr>
  <tr>
    <td>Giá</td>
    <td><input name="PRICE" type="text" size="20" /> (VNĐ) </td>
  </tr>
  <tr>
    <td>Bảo Hành</td>
    <td><input name="GUARANTY" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>Thông tin khuyến mãi</td>
    <td><textarea name="OFFER" rows="4" cols="38"></textarea></td>
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
			echo "<option value='".$row['ID']."'>".$row['BRANDNAME']."</option>";
		  }
		}
    ?></select>
    </td>
  </tr>
    <tr>
    <td>Mạng</td>
    <td><input name="NETWORK" type="text" size="30"  /></td>
  </tr>
    <tr>
    <td>2G</td>
    <td><input name="2G" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>3G</td>
    <td><input name="3G" type="text" size="30"  /></td>
  </tr>

  <tr>
    <td>Hệ điều hành</td>
    <td><select name="OSID">
    <?php
		$query = "SELECT * FROM OS";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
			echo "<option value='".$row['ID']."'>".$row['OSNAME']."</option>";
		  }
		}
    ?></select>
    </td>
  </tr>
      <tr>
    <td>CPU</td>
    <td><input name="CPU" type="text" size="30"  /></td>
  </tr>	
  <tr>
    <td>Kích thước màn hình</td>
    <td><input name="DISPLAYSIZE" type="text" size="30"  /></td>
  </tr>
    <tr>
    <td>Độ phân giải màn hình</td>
    <td><input name="DIMENSION" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>Khối lượng</td>
    <td><input name="WEIGHT" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>Thiết kế</td>
    <td><input name="DESIGN" type="text" size="30"  /></td>
  </tr>
    <tr>
    <td>Thông tin hiển thị khác</td>
    <td><textarea name="DISPLAY_OTHER" rows="4" cols="38"></textarea></td>
  </tr>
    <tr>
    <th class="full" colspan="2">Tính năng</th>
  </tr>
  <tr>
    <td>Máy ảnh</td>
    <td><input name="CAMERA" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>Quay video</td>
    <td><input name="VIDEORECORD" type="checkbox" value="1"  /></td>
  </tr>
    <tr>
    <td>Thông tin máy ảnh khác</td>
    <td><textarea name="CAMERA_OTHER" rows="4" cols="38"></textarea></td>
  </tr>
  <tr>
    <td>Âm thanh</td>
    <td><input name="SOUND" type="text" size="30"  /></td>
  </tr>
    <tr>
    <td>Bộ nhớ ngoài</td>
    <td><input name="EXT_MEMORY" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>Bộ nhớ trong</td>
    <td><input name="INT_MEMORY" type="text" size="30"  /></td>
  </tr>
      <tr>
    <td>Pin</td>
    <td><input name="BATTERYINFO" type="text" size="30"  /></td>
  </tr>
   <tr>
    <td>Tin nhắn</td>
    <td><input name="MESSAGING" type="text" size="30"  /></td>
  </tr>
  <tr>
    <td>USB</td>
    <td><input name="USB" type="text" size="30"   /></td>
  </tr>
  <tr>
    <td>Trình duyệt</td>
    <td><input name="BROWSER" type="text" size="30" /></td>
  </tr>
  <tr>
    <td>EDGE</td>
    <td><input name="EDGE" type="checkbox" value="1"  /></td>
  </tr>
  <tr>
    <td>WIFI</td>
    <td><input name="WIFI" type="checkbox" value="1" /></td>
  </tr>
  <tr>
    <td>GPS</td>
    <td><input name="GPS" type="checkbox" value="1" /></td>
  </tr>
  <tr>
    <td>BLUETOOTH</td>
    <td><input name="BLUETOOTH" type="checkbox" value="1" /></td>
  </tr>
  <tr>
    <td>RADIO</td>
    <td><input name="RADIO"  type="checkbox" value="1"  /></td>
  </tr>
  <tr>
    <td>JAVA</td>
    <td><input name="JAVA" type="checkbox" value="1" /></td>
  </tr>

  <tr>
    <td>Bàn phím QWERTY</td>
    <td><input name="QWERTY"  type="checkbox" value="1" /></td>
  </tr>
  <tr>
    <td>Các tính năng khác</td>
    <td><textarea name="FEATURE_OTHER" rows="4" cols="38"></textarea></td>
  </tr>
  <tr>
    
    <td colspan="2">
      <input type="hidden" name="add_product" value="added" />
      <center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
  
</form>
