<?
$toplist = array("new" => array("title"=>"mới nhất",
                             "field"=>"DATEADD",
                             "order"=>"DESC"),
                 "view" => array("title"=>"được xem nhiều nhất",
                                      "field"=>"VIEWS",
                                      "order"=>"DESC"), 
                 "cheap" => array("title"=>"rẻ nhất",
                                  "field"=>"PRICE",
                                  "order"=>"ASC"));
$type = isset($_GET['show'])?$_GET['show']:""; 
if(!isset($_GET['show']) || $_GET['show'] == NULL && !isset($toplist[$type])){
foreach($toplist as $type => $info){
  $item = top_item('Product',$info['field'],$info['order'],9);
  if($type == "new")
    $icon_new = "<img src=\"./images/icon_new.gif\" align=\"top\" style=\"border: 0px\">";
  else
    $icon_new = "";
?>
  <h1>Sản phẩm <?echo $info['title'];?></h1> 
  <p>
          <div class="listitem">
          <?php foreach($item as $product){?>
            <div class="item">
					  <a href="?page=product_detail&id=<?echo $product['ID']?>"><img src="<?echo $product['THUMBNAIL']?>" alt="<?echo $product['DESCRIPTION']?>" width="120" height="124" /><br />  
					  <?echo $product['NAME'].$icon_new;?></a><br />
            <?echo number_format($product['PRICE']);?> VNĐ <br />
           <? add2cart($product['ID']); ?>
            </div>
          <? } ?>
            </div>
  </p>
  <div style="text-align:right; font-weight:bolder; padding-right: 30px"><a href="?page=products&show=<?echo $type;?>"><input type="button" value="Hiên thị tất cả" style="padding: 6px 20px; color: #000;border: 1px solid #CCC"/></a></div>
  <div class="clear"></div>
  <br />
<?  }
  }else{
  $info = $toplist[$_GET['show']];
  $field = $info['field'];
  $ordertype = $info['order'];
  if(!isset($_GET['item']) || $_GET['item'] == NULL)
    $item_per_page = 12;
  else
    $item_per_page = $_GET['item'];
  $query = "SELECT * FROM Product ORDER BY $field $ordertype";
  $data = Paging('Product',$item_per_page,$query);
  $result_count = mysql_num_rows($data['result']);
?>
<h1>Sản phẩm <?echo $info['title'];?> | Hiển thị:
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
<p>
        <div class="listitem">
        <?php while($row = mysql_fetch_array($data['result'])){ ?>
          <div class="item">
					<a href="?page=product_detail&id=<?echo $row['ID']?>"><img src="<?echo $row['THUMBNAIL']?>" alt="<?echo $row['DESCRIPTION']?>" width="120" height="124" /><br />  
					<?echo $row['NAME']?></a><br />
          <?echo number_format($row['PRICE']);?> VNĐ<br />
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
  <? } ?>
