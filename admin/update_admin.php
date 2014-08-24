<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
$query = "SELECT * FROM Admin WHERE ID = $id";
$result = mysql_query($query);
if($result){
  $row = mysql_fetch_array($result);
$username=$row['USERNAME'];
$name=$row['NAME'];
$email=$row['EMAIL'];
$gender=$row['GENDER'];
$address=$row['ADDRESS'];
$groupid=$row['GROUP_ID'];

}else{
  echo "<h2>Không tìm thấy bài viết nào !</h2>";
  return 0;
}
?>
<div class="top-bar">
                    <h1>Thêm quản trị viên</h1>
</div>
<br />
<form name="update_admin" action="?page=admin_query&action=update&id=<?echo $id?>" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin quản trị viên</th>
  </tr>

  <tr>
    <td width="50%">Tên đăng nhập</td>
    <td width="50%">
      <input name="USERNAME" value="<?echo $username?>" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Mật khẩu</td>
    <td>
      <input name="PASSWORD" type="password" size="30" />
    </td>
  </tr>
  <tr>
    <td>Nhập lại mật khẩu</td>
    <td>
      <input name="REPASS" type="password" size="30" />
    </td>
  </tr>
  <tr>
    <td>Họ và tên</td>
    <td>
      <input name="NAME" value='<?echo $name?>' type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>
      <input name="EMAIL" value='<?echo $email?>' type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Giới tính</td>
    <td>
      <?
        $checknam = $gender?"checked='checked'":"";
        $checknu = $gender?"":"checked='checked'";
      ?>
      <input name="GENDER" type="radio" value="1" <?echo $checknam?> />Nam
      <input name="GENDER" type="radio" value="0" <?echo $checknu?> />Nữ
    </td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td>
      <textarea name="ADDRESS" rows="4" cols="38"><?echo $address?></textarea>
    </td>
  </tr>
    <td>Nhóm</td>
    <td><select name="GROUP_ID">
    <?php
		$query = "SELECT * FROM AdminGroup";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
        if($groupid == $row['ID'])
          echo "<option value='".$row['ID']."' selected='selected'>".$row['GROUPNAME']."</option>";
        else
          echo "<option value='".$row['ID']."'>".$row['GROUPNAME']."</option>";
		  }
		}
    ?></select>
    </td>
  </tr>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
  
</form>
