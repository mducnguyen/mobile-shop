<?php
if(!CheckLogin("admin"))
  returnPage_admin();
$query="SELECT * FROM  Admin where ID=".$_SESSION['admin_id'];
$result=mysql_query($query);

$rows=mysql_fetch_array($result)
?>
<div class="block">
  <h1>Thông tin đăng nhập</h1>
<table style="border-collapse:collapse; width:100%">
  <tr>
    <td width="30%">Tên đăng nhập</td>
    <td width="70%"><? echo $rows['USERNAME']; ?></td>
  </tr>
  <tr>
    <td>Mật khẩu</td>
    <td>*********</td>
  </tr>
    <tr>
    <td style="text-align:center" colspan="2">
<a href="?page=edit_account&action=change_pass"><input type="button" class="button" style="padding: 3px" name="btnEdit" value="Thay đổi mật khẩu" /></a>
</td>
  </tr>
</table>
  <h1>Thông tin cá nhân</h1>
<table style="border-collapse:collapse; width:100%">
  <tr>
    <td width="30%">Họ và tên</td>
    <td width="70%"><? echo $rows['NAME']; ?></td>
  </tr>
  <tr>
    <td>Giới tính</td>
    <td><?
    $gender = $rows['GENDER']?"Nam":"Nữ";
    echo $gender; ?>
</td>
  </tr>
  <tr>
    <td>Email</td>
    <td><? echo $rows['EMAIL']; ?></td>
  </tr>
  <tr>
    <td>Điện thoại</td>
    <td><? echo $rows['MOBILE']; ?></td>
  </tr>
  <tr>
    <td>Di động</td>
    <td><? echo $rows['PHONE']; ?></td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td><? echo $rows['ADDRESS']; ?></td>
  </tr>
      <td>Ngày sinh</td>
    <td><? echo $rows['DOB']; ?></td>
  </tr>
  <tr>
    <td>Thành phố</td>
    <td><? echo $rows['CITY']; ?></td>
  </tr>

  <tr>
    <td style="text-align:center" colspan="2">
<a href="?page=edit_account&action=change_info"><input type="button" class="button" style="padding: 3px" name="btnEdit" value="Chỉnh sửa" /></a>
</td>
  </tr>
  </table>
</div>
