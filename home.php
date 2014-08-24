<script type="text/javascript" src="./scripts/coin-slider.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#coin-slider').coinslider({ width: 550, delay: 5000, effect: 'random' });
	});
</script>


<?
  $top_important = top_item("News","RAND()","DESC",8,"SELECT * FROM News WHERE `IMPORTANT`=1 ");
  if(sizeof($top_important)==0){
  }else{
?>
<div id='coin-slider'>
      <?foreach($top_important as $row){ ?>
    <a href='?page=view_news&id=<?echo $row['ID'];?>'>
		<img src='<?echo $row['THUMBNAIL'];?>' >
		<span>
			<b><?echo $row['TITLE'];?></b>
      <br />
      <?echo $row['DESCRIPTION'];?>
		</span>
	</a>
<? }
echo "</div>"; 
} ?>


<h1>Tin tức mới</h1> 
<?  $top_new = top_item("News","TIME");
  if(sizeof($top_new)==0){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Không thể kết nối đến cơ sở dữ liệu. Quý khách vui lòng thử lại sau.</h3>";
  }else{
?>
  <div class="news">
    <ul>
      <?foreach($top_new as $row){ ?>
<li>
            	<div class="n2img">
                	<a href="?page=view_news&id=<?echo $row['ID'];?>" title="<?echo $row['TITLE'];?>">
                		<img src="<?echo $row['THUMBNAIL'];?>" alt="<?echo $row['TITLE'];?>" height="99" width="132">
            		</a>
                </div>
                <div class="n2title"><a href="?page=view_news&id=<?echo $row['ID'];?>" title="<?echo $row['TITLE'];?>"><?echo $row['TITLE'];?></a></div>

                <div class="n2intro"><p><?echo $row['DESCRIPTION'];?></p></div>

                
                <div class="n2update">Cập nhật: <span style="color:#aaa"><?php echo date("d/m/Y",$row['TIME'])?></span></div>
            </li>
<? }
echo " </ul></div>";
 } ?>


<?
$toplist = array("new" => array("title"=>"mới nhất",
                             "field"=>"DATEADD",
                             "order"=>"DESC"));
foreach($toplist as $type => $info){
  $item = top_item('Product',$info['field'],$info['order'],9);
  if($type == "new")
    $icon_new = " <img src=\"./images/icon_new.gif\" align=\"top\" style=\"border: 0px\">";
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
            <?echo number_format($product['PRICE']);?> VNĐ<br />
            <? add2cart($product['ID']);?>
            </div>
          <? } ?>
            </div>
  </p>
  <div style="text-align:right; font-weight:bolder; padding-right: 30px"><a href="?page=products&show=<?echo $type;?>"><input type="button" value="Hiên thị tất cả" style="padding: 6px 20px; color: #000;border: 1px solid #CCC"/></a></div>
  <div class="clear"></div>
  <br />
<?}?>
