<?
  $BRANDID = isset($_GET['BRANDID'])?$_GET['BRANDID']:0;
  $OSID = isset($_GET['OSID'])?$_GET['OSID']:0;
  $EDGE = isset($_GET['EDGE']) && $_GET['EDGE']?"checked='checked'":"" ;
  $GPS = isset($_GET['GPS']) && $_GET['GPS']?"checked='checked'":"" ;
  $BLUETOOTH = isset($_GET['BLUETOOTH']) && $_GET['BLUETOOTH']?"checked='checked'":"" ;
  $WIFI = isset($_GET['WIFI']) && $_GET['WIFI']?"checked='checked'":"" ;
  $RADIO = isset($_GET['RADIO']) && $_GET['RADIO']?"checked='checked'":"" ;
  $QWERTY = isset($_GET['QWERTY']) && $_GET['QWERTY']?"checked='checked'":"" ;
  $CAMERA = isset($_GET['CAMERA']) && $_GET['CAMERA']?"checked='checked'":"" ;
  $JAVA = isset($_GET['JAVA']) && $_GET['JAVA']?"checked='checked'":"" ;
  $VIDEORECORD = isset($_GET['VIDEORECORD']) && $_GET['VIDEORECORD']?"checked='checked'":"" ;
?>
    </div>
<script type="text/javascript">
   $(document).ready(function(){
      $('#product_search').autocomplete("phone_search.php?action=search", {
          width: 200,
          matchContains: true,
          selectFirst: false
        });
      });
</script>
<div id="sidebar">
  <h1>Tìm kiếm sản phẩm</h1>
    <form id="search_form" name="search" action="<?echo $_SERVER['PHP_SELF'];?>" method="GET">
    <table style="padding: 0px;">
        <tr>
          <td colspan="2">
              <input type="hidden" name="page" value="product_search"/>
              <input type="text" id="product_search" name="SEARCH" style="width:95%; height: 20px; font-size: 1.2em"/>
          </td>
         </tr>
         <tr>
           <td colspan="2">
              <select name="PRICE" style="width: 100%; height:30px;font-size:1.2em;">
              <?php
              $price_range = array("--Mức giá--" => ""
                                  ,"Dưới một triệu" => "0-1000000"
                                  ,"1 - 2 triệu" => "1000000-2000000"
                                  ,"2 - 4 triệu" => "2000000-4000000"
                                  ,"4 - 8 triệu" => "4000000-8000000"
                                  ,"8 - 10 triệu" => "8000000-10000000"
                                  ,"Trên 10 triệu" => "10000000");
              foreach($price_range as $key => $value){
                if(isset($_GET['PRICE']) && $value == $_GET['PRICE'])
                  echo "<option value=\"$value\" selected=\"selected\">$key</option>";
                else
                  echo "<option value=\"$value\">$key</option>";
              }
              ?>
              </select>
           </td>
         </tr>
      
         <tr>
          <td colspan="2">
              <select style="width: 100%; height:30px;font-size:1.2em;" name="OSID">
              <option value="">--Hệ điều hành--</option>
    <?php
		$query = "SELECT * FROM OS";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
        if($row['ID'] == $OSID){
          echo "<option value='".$row['ID']."' selected='selected'>".$row['OSNAME']."</option>";
        }
        else
          echo "<option value='".$row['ID']."' >".$row['OSNAME']."</option>";
		  }
		}
    ?></select>
       </td>
       </tr>
       <tr>
       <td colspan="2">
       <select style="width: 100%; height:30px;font-size:1.2em" name="BRANDID">
            <option value="">--Hãng sản xuất--</option>
    <?php
		$query = "SELECT * FROM Brand";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
        if($row['ID'] == $BRANDID)
          echo "<option value='".$row['ID']."' selected='selected'>".$row['BRANDNAME']."</option>";
        else
          echo "<option value='".$row['ID']."'>".$row['BRANDNAME']."</option>";
		  }
		}
    ?></select>
       </td>
       </tr>
      <tr>
        <td width="50%"><input name="EDGE" type="checkbox" <?echo $EDGE;?> value="1"  /> Edge</td>
        <td width="50%"><input name="WIFI" type="checkbox" <?echo $WIFI;?> value="1" /> Wifi</td>
      </tr>
      <tr>
        <td><input name="GPS" type="checkbox" <?echo $GPS;?> value="1"  /> GPS</td>
        <td><input name="BLUETOOTH" type="checkbox" <?echo $BLUETOOTH;?> value="1" /> Bluetooth</td>
      </tr>
      <tr>
        <td><input name="RADIO" type="checkbox" <?echo $RADIO;?> value="1"  /> Đài FM</td>
        <td><input name="CAMERA" type="checkbox" <?echo $CAMERA;?> value="1" /> Camera</td>
      </tr>
      <tr>
        <td><input name="QWERTY" type="checkbox" <?echo $QWERTY;?> value="1"  /> Qwerty</td>
        <td><input name="VIDEORECORD" type="checkbox" <?echo $VIDEORECORD;?> value="1" /> Quay video</td>
      </tr>
      <tr>
        <td><input name="JAVA" type="checkbox" <?echo $JAVA;?> value="1"  /> Java</td>
      </tr>
    </table>
    <center><input type="submit" style="padding: 5px;" class='button' name="btnsearch" value="Tìm kiếm"/></center>
        </form>

      <h1>Hãng sản xuất</h1>
      <ul class="sidemenu">
        <?php
          $query = "SELECT * FROM Brand";
          $result = mysql_query($query);
          if(!$result || mysql_num_rows($result) == 0)
            return;
          while($row = mysql_fetch_array($result)){
            echo "<li><a href='?page=product_search&BRANDID=".$row['ID']."'>".$row['BRANDNAME']."</a></li>";
          }
        ?>
      </ul>
      <h1>Sản phẩm ưa chuộng</h1>
      <?php  
        $item = top_item("Product","VIEWS");
        foreach($item as $product){
          $id = $product['ID'];
          $thumbnail = $product['THUMBNAIL'];
          $name = $product['NAME'];
        ?>
        <li style="list-style:none; margin:3px">
        <a href="?page=product_detail&id=<?echo $id;?>"><img src="<?php echo $thumbnail; ?>" style='vertical-align:middle' width="60" height="60"/> <?echo $name;?></a>
        </li>
        <? } ?>
      <h1>Tin mới</h1>
      <?php  
        $item = top_item("News","TIME","DESC",10);
        foreach($item as $news){
          $id = $news['ID'];
          $thumbnail = $news['THUMBNAIL'];
          $title = $news['TITLE'];
        ?>
        <li style="list-style:none; margin:3px;border-bottom:1px dotted #737373;padding:4px">
        <a href="?page=view_news&id=<?echo $id;?>"><img src="<?php echo $thumbnail; ?>" align="middle" width="60" height="30"/> <?echo $title;?></a>
        </li>
        <? } ?>
        
      <h1>Quảng cáo</h1>  
      <img src="http://localhost/home/prj/images/123.gif" width="190" height="300" style="margin: 3px;" />
    </div>
  </div>
	
	
