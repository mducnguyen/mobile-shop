<script type="text/javascript">var switchTo5x=true;</script>
<script type="text/javascript" src="./scripts/sharethis.js"></script>
<script type="text/javascript">stLight.options({publisher:'75111501-5677-4bdf-b891-6861914c7ea8'});</script>
<?
if(!isset($_GET['id']) && $_GET['id'] == NULL){
  header("location:?page=products");
}
$id = mysql_real_escape_string($_GET['id']);
$query = "SELECT * FROM Product WHERE ID = $id";
$result = mysql_query($query);
if(!$result || mysql_num_rows($result)==0){
  echo "<h1>Có lỗi xảy ra</h1>";
  echo "<div class='block' style='margin: 0px; margin-top: 10px'>";
  echo "<h3>Không tìm thấy sản phẩm. Sản phẩm có thể đã bị xóa. Xin vui lòng thử lại sau</h3>";
  echo "<a href='?page=return'>Ấn vào đây để quay trở lại trang vừa truy cập</a>";
}else{
// HIEN THI
show_product_info($id);
// COMMENT
}
?>
<hr style='margin: 9px 0px;'/>
<div style='text-align:left; margin-left:5px'><span  class='st_twitter_large' ></span><span  class='st_facebook_large' ></span><span  class='st_google_bmarks_large' ></span><span  class='st_yahoo_large' ></span><span  class='st_email_large' ></span><span  class='st_sharethis_large' ></span></div>
<h1>Bình luận</h1>
<?
$query = "SELECT * FROM Comment WHERE PRODUCT_ID = $id";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
  $name = $row['NAME'];
  $email = $row['EMAIL'];
  $content = $row['CONTENT'];
  $time = date("d/m/Y",$row['TIME']);;
  echo "<div class='block' style='border-bottom:1px dotted #737373; padding: 10px'>
  <b>Tên</b>: $name - [$time]<br />
  <b>Email</b>: $email <br />
  <hr style=''/><br />
  <pre>$content</pre>
  </div>";
}
?>
<h1>Gửi bình luận</h1>
      <form action="?page=send_comment" method="POST">
        <?php if(!CheckLogin('customer')){?>
        <p>
          <label>Tên <span style="color:red">*</span></label>
          <input name="NAME" type="text" size="30" />
          <label>Email <span style="color:red">*</span></label> 
          <input name="EMAIL" type="text" size="30" />
          <label>Điện thoại</label>
          <input name="PHONE" type="text" size="30" />
          <label>Địa chỉ</label>
          <input name="ADDRESS" type="text" size="30" />
        <? }else{ 
          $query = "SELECT * FROM Customer WHERE ID=".$_SESSION['userid'];
          $result = mysql_query($query);
          $row = mysql_fetch_array($result);
          ?>
          <label>Tên <span style="color:red">*</span></label>
          <input disabled="disabled" value="<?echo $row['NAME']?>" type="text" size="30" />
          <input name="NAME" value="<?echo $row['NAME']?>" type="hidden"/>
          <label>Email <span style="color:red">*</span></label> 
          <input disabled="disabled" value="<?echo $row['EMAIL']?>" type="text" size="30" />
          <input name="EMAIL" value="<?echo $row['EMAIL']?>" type="hidden"/>
          <label>Điện thoại</label>
          <input disabled="disabled" value="<?echo $row['PHONE']?>" type="text" size="30" />
          <input name="PHONE" value="<?echo $row['PHONE']?>" type="hidden" />
          <label>Địa chỉ</label>
          <input disabled="disabled" value="<?echo $row['ADDRESS']?>" type="text" size="30" />
          <input name="ADDRESS" value="<?echo $row['ADDRESS']?>" type="hidden" />
        <? } ?>
          <label>Nội dung <span style="color:red">*</span></label> 
          <textarea name="CONTENT" rows="6" cols="50"></textarea>
          <br />  
          <img id="captcha" src="./securimage/securimage_show.php" alt="CAPTCHA Image" />
          <br />
          <input type="text" style="margin-bottom: 3px; height: 20px" name="captcha_code" size="10" maxlength="6" /> <span style="color:red">*</span>
          <a href="#" onclick="document.getElementById('captcha').src = './securimage/securimage_show.php?' + Math.random(); return false">[ Đổi ]</a>
          <br />
          <input type="hidden" name="productid" value="<?echo $id?>"/>
          <input class="button" name="comment_submit" style="padding: 3px 20px" type="submit" value="Gửi"/>
        </p>
      </form>

<h1>Các sản phẩm khác</h1>
<?php
$query = "SELECT * FROM Product ORDER BY RAND() LIMIT 8 ";
$result = mysql_query($query);
if(!$result){
}else{
  echo "<div class=\"listitem\">";
  while($row = mysql_fetch_array($result)){
     $id = $row['ID'];
     $name = $row['NAME'];
     $thumbnail = $row['THUMBNAIL'];
     $description = $row['DESCRIPTION'];
     $price = $row['PRICE'];
     echo "<div class=\"item\" style='width:110px;height:160px'>";
     echo "<a href='?page=product_detail&id=$id'><img src=\"$thumbnail\" alt=\"$description\" width=\"90\" height=\"100\" /><br />";
     echo $name."</a><br />";
     echo number_format($price)." VNĐ <br />";
     echo "</div>";
  } 
  echo "</div>";
}
// 
$query = "SELECT VIEWS FROM Product WHERE ID=".$_GET['id'];
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$view = $row['VIEWS'] + 1;
$query = "UPDATE Product SET `VIEWS`='$view' WHERE ID=".$_GET['id'];
mysql_query($query);
?>

