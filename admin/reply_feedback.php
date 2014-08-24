<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
$query = "SELECT * FROM Feedback WHERE ID = $id";
$result = mysql_query($query);
if($result){
  $row = mysql_fetch_array($result);
}else{
  echo "<h2>Không tìm thấy dữ liệu nào !</h2>";
  return 0;
}
$name = $row['NAME'];
$email = $row['EMAIL'];
$phone = $row['PHONE'];
$address = $row['ADDRESS'];
$content = $row['CONTENT'];
 ?>
<div class="top-bar">
<h1>Cập nhật hệ điều hành</h1>
</div>
<br />
<form name="add_product" action="?page=send_reply&email=<?echo $email;?>" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
   <tr>
    <th class="full" colspan="2">Góp ý khách hàng</th>
  </tr>

  <tr>
    <td colspan='2' style='height:30px;font-size: 13px'><b>Tên</b>: <?echo $name;?></td>
  </tr>
    <tr>
    <td colspan='2' style='height:30px;font-size: 13px'><b>Email</b>: <?echo $email;?></td>
  </tr>
     <tr>
    <td colspan='2' style='height:30px;font-size: 13px'><b>Điện thoại</b>: <?echo $phone;?></td>
  </tr>
       <tr>
    <td colspan='2' style='height:30px;font-size: 13px'><b>Nội dung</b>:<br /> <?echo $content;?></td>
  </tr>
         <tr>
    <td colspan='2' style='height:30px;font-size: 13px'><b>Trả lời:</b><br />
    <textarea name='reply' rows="6" cols="80"></textarea>
    </td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Gửi" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
  
</form>
