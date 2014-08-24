<div class="top-bar">
                    <h1>Thêm khách hàng</h1>
</div>
<br />
<form name="add_customer" action="?page=customer_query&action=add" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin khách hàng</th>
  </tr>

  <tr>
    <td width="50%">Họ và tên</td>
    <td width="50%">
      <input name="NAME" type="text" size="30" />
    </td>
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
    <td>Giới tính</td>
    <td>
      <input name="GENDER" type="radio" value="1" checked="checked" />Nam
      <input name="GENDER" type="radio" value="0" />Nữ
    </td>
  </tr>
  <tr>
    <td>Email</td>
    <td>
      <input name="EMAIL" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Điện thoại</td>
    <td>
      <input name="PHONE" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Di động</td>
    <td>
      <input name="MOBILE" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Địa chỉ</td>
    <td>
      <textarea name="ADDRESS" rows="4" cols="38"></textarea>
    </td>
  </tr>
      <td>Ngày sinh</td>
    <td><select name="DATE">
  <?php for($i=1; $i<=31;++$i)
      echo "<option value='$i'>$i</option>";  ?>
      </select>
    <select name="MONTH">
  <?php for($i=1; $i<=12;++$i)
      echo "<option value='$i'>$i</option>";  ?>
  </select>
  <select name="YEAR">
  <?php
  for($i=1930; $i<=date("Y");++$i)
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
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
  
</form>

