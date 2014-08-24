<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
$query = "SELECT * FROM News WHERE ID = $id";
$result = mysql_query($query);
if($result){
  $row = mysql_fetch_array($result);
}else{
  echo "<h2>Không tìm thấy bài viết nào !</h2>";
  return 0;
}
$title=$row["TITLE"];
$description=$row["DESCRIPTION"];		
$important = $row['IMPORTANT']?"checked='checked'":"";
$thumbnail = $row['THUMBNAIL'];
$content  = $row['CONTENT'];
 ?>
<div class="top-bar">
                    <h1>Sửa tin tức</h1>
</div>
<br />
<form name="add_admin" action="?page=news_query&action=update&id=<?echo $id;?>" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th>
      Tiêu đề: <input name="TITLE" value="<?echo $title?>" type="text" size="50" />
    </th>
  </tr>
   <tr>
    <th>
      <b>Miêu tả: <input name="DESCRIPTION" value="<?echo $description;?>" type="text" size="50" /></b>
    </th>
  </tr>
   <tr>
    <td>
      <b>Tin quan trọng: <input name="IMPORTANT" <?echo $important;?> type="checkbox" value="1" /></b>
    </td>
  </tr>
  <tr>
    <td><textarea class="ckeditor" name="CONTENT" onKeyUp=""><?echo $content;?></textarea></td>
  </tr>
      <tr>
    <td>
      <p style="font-weight: bold">Ảnh đại diện: <input name="THUMBNAIL" value="<?echo $thumbnail;?>" type="text" size="50" /></p>
      <img src="<?echo $thumbnail;?>" width=200 height=200/>
    </td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  
  </table>
  <div id="news_preview">
  </div>
</div>
</form>

