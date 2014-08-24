<div class="top-bar">
                    <h1>Thêm quản trị viên</h1>
</div>
<br />
<form name="add_admin" action="?page=admin_query&action=add" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin quản trị viên</th>
  </tr>

  <tr>
    <td width="50%">Tên đăng nhập</td>
    <td width="50%">
      <input name="USERNAME" type="text" size="30" />
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
      <input name="NAME" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>
      <input name="EMAIL" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Giới tính</td>
    <td>
      <input name="GENDER" type="radio" value="1" checked="checked" />Nam
      <input name="GENDER" type="radio" value="0" />Nữ
    </td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td>
      <textarea name="ADDRESS" rows="4" cols="38"></textarea>
    </td>
  </tr>
    <td>Nhóm</td>
    <td><select name="GROUP_ID">
    <?php
		$query = "SELECT * FROM AdminGroup";
		$result = mysql_query($query);
		if($result){
		  while($row = mysql_fetch_array($result)){
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

