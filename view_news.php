<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="./scripts/sharethis.js"></script>
<script type="text/javascript">stLight.options({publisher:'75111501-5677-4bdf-b891-6861914c7ea8'});</script>
<?
if(!isset($_GET['id']) && $_GET['id'] == NULL){
  header("location:?page=news");
}
$id = mysql_real_escape_string($_GET['id']);
$query = "SELECT * FROM News WHERE ID = ".$id;
$result = mysql_query($query);
if(!$result || mysql_num_rows($result)==0){
  echo "<h1>Có lỗi xảy ra</h1>";
  echo "<div class='block' style='margin: 0px; margin-top: 10px'>";
  echo "<h3>Không tìm thấy bài viết. Bài viết có thể đã bị xóa. Xin vui lòng thử lại sau</h3>";
  echo "<a href='?page=return'>Ấn vào đây để quay trở lại trang vừa truy cập</a>";
}else{
$row = mysql_fetch_array($result);
$id = $row['ID'];
$adminid = $row['ADMIN_ID'];
$time = date("d/m/Y",$row['TIME']);
$title = $row['TITLE'];
$description = $row['DESCRIPTION'];
$content =  $row['CONTENT'];
$views = $row['V'];
$query = "SELECT * FROM Admin WHERE ID = $adminid";
$row = @mysql_fetch_array(mysql_query($query));
$admin = $row['NAME'];
echo "<a href='?page=view_news&id=$id'><h1>$title</h1></a>";
echo "<div class='block' style='margin: 0px; margin-top: 10px'>";
echo "<div style='color:#aaa; margin: 2px;text-align:right;'>Cập nhật ngày: $time bởi $admin</div>";
echo "<h3 class='description'>$description</h3>";
echo $content;
}
?>
<hr style='margin: 9px 0px;'/>
<div style='text-align:left; margin-left:5px'><span  class='st_twitter_large' ></span><span  class='st_facebook_large' ></span><span  class='st_google_bmarks_large' ></span><span  class='st_yahoo_large' ></span><span  class='st_email_large' ></span><span  class='st_sharethis_large' ></span></div>

<h1>Các tin khác</h1>

<ul class="other_news">
<?php
$query = "SELECT * FROM News ORDER BY RAND() LIMIT 10 ";
$result = mysql_query($query);
if(!$result){
}else{
  while($row = mysql_fetch_array($result)){
    $id = $row['ID'];
    $title = $row['TITLE'];
    $time = date("d/m/Y",$row['TIME']);
    echo "<li><a href='?page=view_news&id=$id' title='$title'>$title</a> - <span style='color:#aaa'>[$time]</span></li>";
  }
}
?>
</ul>
</div>
<br />
