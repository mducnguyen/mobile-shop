<div class="block">
<?
  $set_prev_page = 0;
  if(!CheckLogin('customer'))
    returnPage_user();

  $query = "SELECT * FROM Customer WHERE ID=".$_SESSION['userid'];
  $result = mysql_query($query);
  if(!$result){ 
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Không thể kết nối đến cơ sở dữ liệu. Xin quý khách vui lòng thử lại sau</h3>";
  }else{
    $row = mysql_fetch_array($result);
    if(!isset($_GET['action']) || $_GET == NULL)
      returnPage_user();
    if($_GET['action'] == "change_pass"){
    ?>
<h1>Chỉnh sửa thông tin đăng nhập</h1>
<form name="edit_account_info" action="?page=account_query&action=change_pass" method="POST" >
<table style="width:100%">
  <tr>
    <td width="30%">Tên đăng nhập</td>
    <td width="70%"><?echo $row['USERNAME']; ?></td>
  </tr>
  <tr>
    <td>Mật khẩu cũ</td>
    <td><input name="OLDPASS" type="password" /></td>
  </tr>
    <tr>
    <td>Mật khẩu mới</td>
    <td><input name="NEWPASS" type="password" /></td>
  </tr>
    <tr>
    <td>Mật khẩu cũ</td>
    <td><input name="REPASS" type="password" /></td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnSubmit" value="OK" />
    <input type="hidden" name="change_pass" value="1" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</form>  
 <? }else{ ?>
<h1>Chỉnh sửa thông tin cá nhân</h1>
<form name="edit_account_info" action="?page=account_query&action=change_info" method="POST" >
<table style="width:100%">
  <tr>
    <td width="50%">Họ và tên</td>
    <td width="50%">
      <input name="NAME" type="text" size="30" value="<?echo $row['NAME'];?>" />
    </td>
  </tr>
  <tr>
    <td>Giới tính</td>
    <td>
    <?php
      $nam = $row['GENDER']?"checked='checked'":"";
      $nu = $row['GENDER']?"":"checked='checked'";
    ?>
      <input name="GENDER" type="radio" value="1" <?echo $nam;?> />Nam
      <input name="GENDER" type="radio" value="0" <?echo $nu;?>/>Nữ
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>
      <input name="EMAIL" type="text" value="<?echo $row['EMAIL'];?>" size="30" />
    </td>
  </tr>
  <tr>
    <td>Điện thoại</td>
    <td>
      <input name="PHONE" type="text" value="<?echo $row['PHONE'];?>" size="30" />
    </td>
  </tr>
  <tr>
    <td>Di động</td>
    <td>
      <input name="MOBILE" type="text" value="<?echo $row['MOBILE'];?>" size="30" />
    </td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td>
      <textarea name="ADDRESS" rows="4" cols="38"><?echo $row['ADDRESS'];?></textarea>
    </td>
  </tr>
      <td>Ngày sinh</td>
     <?
      $DOB = explode("/",$row['DOB']);
      $date = $DOB[0];
      $month = $DOB[1];
      $year = $DOB[2];
     ?>
    <td><select name="DATE">
  <?php for($i=1; $i<=31;++$i)
    if($date == $i)
          echo "><option value='$i' selected='selected'>$i</option>";
        else
          echo "<option value='$i'>$i</option>";
      echo "<option value='$i'>$i</option>";  ?>
      </select>
    <select name="MONTH">
  <?php for($i=1; $i<=12;++$i)
    if($month == $i)
      echo "<option value='$i' selected='selected'>$i</option>"; 
    else
      echo "<option value='$i'>$i</option>";  ?>
  </select>
  <select name="YEAR">
  <?php
  for($i=1930; $i<=date("Y");++$i)
    if($year == $i)
      echo "<option value='$i' selected='selected'>$i</option>"; 
    else
      echo "<option value='$i'>$i</option>";  ?>
  </select>
    </td>
  </tr>
  <tr>
    <td>Thành phố</td>
    <td>
      <select name="CITY">
    <?php
      foreach($cities as $name)
      echo "<option value='$name'>$name</option>"
    ?>
      </select>
    </td>
  </tr>

  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="OK" />
     <input type="hidden" name="chnage_info" value="1" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</form>
<?php }} ?>
</div>
