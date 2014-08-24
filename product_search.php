<?php
  $search_str = addslashes(trim($_GET['SEARCH']));
  $SEARCH = isset($_GET['SEARCH']) && $_GET['SEARCH'] != NULL?"NAME LIKE \"%$search_str%\"":"1=1";
  $BRANDID = isset($_GET['BRANDID']) && $_GET['BRANDID']?"BRAND_ID=".mysql_real_escape_string($_GET['BRANDID']):"1=1"; 
  $OSID = isset($_GET['OSID']) && $_GET['OSID']?"OS_ID=".mysql_real_escape_string($_GET['OSID']):"1=1"; 
  $EDGE = isset($_GET['EDGE']) && $_GET['EDGE']?"EDGE=".mysql_real_escape_string($_GET['EDGE']):"1=1"; 
  $GPS = isset($_GET['GPS']) && $_GET['GPS']?"GPS=".mysql_real_escape_string($_GET['GPS']):"1=1"; 
  $BLUETOOTH = isset($_GET['BLUETOOTH']) && $_GET['BLUETOOTH']?"BLUETOOTH=".mysql_real_escape_string($_GET['BLUETOOTH']):"1=1"; 
  $WIFI = isset($_GET['WIFI']) && $_GET['WIFI']?"WIFI=".mysql_real_escape_string($_GET['WIFI']):"1=1"; 
  $RADIO = isset($_GET['RADIO']) && $_GET['RADIO']?"RADIO=".mysql_real_escape_string($_GET['RADIO']):"1=1"; 
  $QWERTY = isset($_GET['QWERTY']) && $_GET['QWERTY']?"QWERTY=".mysql_real_escape_string($_GET['QWERTY']):"1=1"; 
  $CAMERA = isset($_GET['CAMERA']) && $_GET['CAMERA']?"CAMERA=".mysql_real_escape_string($_GET['CAMERA']):"1=1"; 
  $JAVA = isset($_GET['JAVA']) && $_GET['JAVA']?"JAVA=".mysql_real_escape_string($_GET['JAVA']):"1=1"; 
  $VIDEORECORD = isset($_GET['VIDEORECORD']) && $_GET['VIDEORECORD']?"VIDEORECORD=".mysql_real_escape_string($_GET['VIDEORECORD']):"1=1";
  $ORDER = isset($_GET['ORDER']) && $_GET['ORDER']?"ORDER BY ".mysql_real_escape_string($_GET['ORDER']):"AND 1=1";
  $ORDER = str_replace('_',' ',$ORDER);
  if(isset($_GET['PRICE']) && $_GET['PRICE']){
    $PRICE = explode("-",$_GET['PRICE']);
    if(sizeof($PRICE)==2){
      $min = $PRICE[0];
      $max = $PRICE[1];
      $PRICE = "PRICE BETWEEN $min AND $max";
    }else if(sizeof($PRICE) == 1)
      $PRICE = "PRICE > ".$PRICE[0];
  }else
    $PRICE = "1=1";
  $query = "SELECT * FROM Product WHERE $BRANDID AND $OSID AND $PRICE AND $GPS AND $BLUETOOTH AND $WIFI AND $EDGE AND $RADIO AND $QWERTY AND $CAMERA AND $JAVA AND $VIDEORECORD AND $SEARCH $ORDER";

if(!isset($_GET['item']) || $_GET['item'] == NULL)
  $item_per_page = 12;
else
  $item_per_page = $_GET['item'];
$data = Paging('Product',$item_per_page,$query);
$result_count = mysql_num_rows($data['result']);
?>
<h1>Kết quả tìm kiểm (<?echo $result_count;?> sản phẩm) | Hiển thị:
<select name="item_per_page" onchange="<?echo $data['js_itemperpage'];?>">
                              <?php
                                $list = array(12,24,36,48,120);
                                foreach($list as $value){
                                  if($value == $item_per_page)
                                    echo "<option value=\"$value\" selected=\"selected\">$value</option>";
                                  else
                                    echo "<option value=\"$value\">$value</option>";
                                }
                              ?>
                            </select></h1>
  <div style="margin: 5px;text-align:right">
    <input type="button" onclick="window.location.href=param_replace('ORDER','DATEADD_DESC')" value="Mới nhất" />
    <input type="button" onclick="window.location.href=param_replace('ORDER','PRICE_ASC')" value="Giá tăng dần" />
    <input type="button" onclick="window.location.href=param_replace('ORDER','PRICE_DESC')" value="Giá giảm dần" />
  </div>
<p>
        <div class="listitem">
        <?php while($row = mysql_fetch_array($data['result'])){ ?>
          <div class="item">
					<img src="<?echo $row['THUMBNAIL']?>" alt="<?echo $row['DESCRIPTION']?>" width="120" height="124" /><br />  
					<a href="?page=product_detail&id=<?echo $row['ID']?>" class="name"><?echo $row['NAME']?></a><br />
          <?echo number_format($row['PRICE']);?> VNĐ <br />
           <? add2cart($row['ID']); ?>
          </div>
        <? } ?>
          </div>
</p>
<div class="clear"></div>
  <form onsubmit="<?echo $data['js_pagejump'];?>" style="text-align:right;font-weight:bold;font-size:13px">
    <?echo $data['backbtn']." ".$data['nextbtn']; ?>
    Đến trang: 
  <input type="text" size="1" id="pagejump" value="<?echo $data['currentpage'];?>" />
   /<span class="style1"><?echo $data['pagenum'];?></span>
   <input type="submit" class="button" value="Đi"> 
  </form> 
