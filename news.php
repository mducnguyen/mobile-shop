<?php if(!isset($_GET['show']) || $_GET['show'] == NULL){ ?>
<h1>Tin tức quan trọng</h1> 
<?
  $top_important = top_item("News","TIME","DESC",5,"SELECT * FROM News WHERE `IMPORTANT`=1");
  if(sizeof($top_important)==0){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Không thể kết nối đến cơ sở dữ liệu. Quý khách vui lòng thử lại sau.</h3>";
  }else{
?>
  <div class="news">
    <ul>
      <?foreach($top_important as $row){ ?>
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

<h1>Tin tức mới</h1> 
<?  $top_new = top_item("News","TIME","DESC",10);
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
<? }?>
<div style="text-align:right; font-weight:bolder; padding:10px"><a href="?page=news&show=news"><input type="button" value="Hiên thị tất cả" style="padding: 6px 20px; color: #000;border: 1px solid #CCC"/></a></div>
  <div class="clear"></div>
</ul></div>
<? }}else{
    echo "<h1>Tin tức</h1>";
    echo "<div class='news'><ul>";
  if(!isset($_GET['item']) || $_GET['item'] == NULL)
    $item_per_page = 12;
  else
    $item_per_page = $_GET['item'];
  $query = "SELECT * FROM News ORDER BY TIME DESC";
  $data = Paging('News',$item_per_page,$query);
  while($row = mysql_fetch_array($data['result'])){
  ?>
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
<?}
echo "</ul></div>";
?>
<form onsubmit="<?echo $data['js_pagejump'];?>" style="text-align:right;font-weight:bold;font-size:13px">
    <?echo $data['backbtn']." ".$data['nextbtn']; ?>
    Đến trang: 
  <input type="text" size="1" id="pagejump" value="<?echo $data['currentpage'];?>" />
   /<span class="style1"><?echo $data['pagenum'];?></span>
   <input type="submit" class="button" value="Đi"> 
  </form> 
<? } ?>
