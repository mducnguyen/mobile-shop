<?php
require_once("authorize.php");
if(CheckLogin('customer')){
  header("location:?page=home");
}
?>

<script type="text/javascript">
function validate(){
	name = document.frmRegister.name;
	regName = /^[a-z\s]*$/i;
	if(name.value=="" || regName.test(name.value)==false) {
		alert("Mời bạn nhập tên!");
		document.frmRegister.name.select();
		document.frmRegister.name.focus();
		return false;
	}
	username = document.frmRegister.username;
	password = document.frmRegister.password;
	repass = document.frmRegister.repass;
	regUser = /^[a-z0-9]{5,20}$/i;
	if(!regUser.test(username.value)) {
		alert("Tên đăng nhập phải từ 5 đến 20 ký tự!");
		document.frmRegister.username.select();
		document.frmRegister.username.focus();
		return false;
	}
	if(username.value=="") {
		alert("Mời bạn nhập tên đăng nhập!");
		document.frmRegister.username.select();
		document.frmRegister.username.focus();
		return false;
	}
	if(!regUser.test(password.value)) {
		alert("Mật khẩu phải từ 5 đến 20 ký tự!");
		document.frmRegister.password.select();
		document.frmRegister.password.focus();
		return false;
	}
	if(repass.value != password.value) {
		alert("Mật khẩu phải trùng nhau!");
		document.frmRegister.repass.select();
		document.frmRegister.repass.focus();
		return false;
	}
	email = document.frmRegister.email;
	emailReg = /^[a-z][\w]*@[a-z][\w]*\.[a-z]{2,4}/i;
	if(!emailReg.test(email.value)) {
		alert("Email sai dinh dang!");
	    document.frmRegister.email.select();
	    document.frmRegister.email.focus();
	    return false;
	}
	phone = document.frmRegister.phone;
	if (phone.value == "") {
		alert("Chưa nhập số điên thoại");
		document.frmRegister.phone.select();
		document.frmRegister.phone.focus();
		return false;
    }
    mobile = document.frmRegister.mobile;
  	mobileReg = /^0\d{9,10}$/;
	if (!mobileReg.test(mobile.value)) {
		alert("Di động sai định dạng");
		document.frmRegister.mobile.select();
		document.frmRegister.mobile.focus();
		return false;
    }
    address = document.frmRegister.address;
  	if(address.value=="") {
  		alert("Bạn chưa chọn địa chỉ!");
		document.frmRegister.address.select();
		document.frmRegister.address.focus();
		return false;
	}
	alert("Chào "+username.value+" Chúc mừng bạn đã đăng ký thành công");
	return true;
 }
</script>
<?php
if(!isset($_POST['registered'])){
?>

<h1>Tạo tài khoản</h1>
<form name="frmRegister" action="?page=register" method="POST">
<table style="border-collapse:collapse; width:100%">
<tr>
  <td width="30%">Họ và tên:</td>
  <td ><input type="text" name="name" size="30" /></td>
</tr>
<tr>
  <td>Tên đăng nhập:</td>
  <td><input type="text" name="username" size="30" /></td>
</tr>
<tr>
  <td>Mật khẩu:</td>
  <td><input type="password" name="password" size="30" /></td>
</tr>
<tr>
  <td>Gõ lại mật khẩu:</td>
  <td><input type="password" name="repass" size="30" /></td>
</tr>
<tr>
  <td>Giới tính:</td>
  <td><input type="radio" name="gender" value="1" checked="checked" />Nam <input type="radio" name="gender" value="0" />Nữ</td>
</tr>
<tr>
  <td>Email:</td>
  <td><input type="text" name="email" size="30" /></td>
</tr>
<tr>
  <td>Điện thoại:</td>
  <td><input type="text" name="phone" size="30" /></td>
</tr>
<tr>
  <td>Di động:</td>
  <td><input type="text" name="mobile" size="30" /></td>
</tr>
<tr>
  <td>Ngày sinh: </td>
  <td>
    <select name="date">
    <?php for($i=1; $i<=31;++$i)
        echo "<option value='$i'>$i</option>";  ?>
    </select>
    <select name="month">
    <?php for($i=1; $i<=12;++$i)
        echo "<option value='$i'>$i</option>";  ?>
    </select>
    <select name="year">
    <?php
    for($i=1930; $i<=date("Y");++$i)
        echo "<option value='$i'>$i</option>";  ?>
    </select>
  </td>
</tr>
<tr>
  <td>Thành phố:</td>
  <td>
    <select name="city">
    <?php
    foreach($cities as $name)
      echo "<option value='$name'>$name</option>"
    ?>
    </select>
  </td>
</tr>
<tr>
  <td>Địa chỉ:</td>
  <td><textarea name="address" rows="3" cols="40"></textarea></td>
</tr>
<tr>
  <td colspan="2" style="text-align:center;">
  <input type="hidden" name="registered" value="registered" />
  <input type="submit" style="font-size:13px; padding: 5px" name="btnSubmit" value="Đăng kí"  onclick="return validate();" />
  <input type="reset" style="font-size:13px; padding: 5px"  name="btnReset" value="Làm lại" />
  </td>
</tr>
</table>
</form>
<?php
}else{
  echo "<div class='block'>";
  $name = mysql_real_escape_string($_POST['name']);
  $username = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);
  $encpass = md5(md5($password));
  $email = mysql_real_escape_string($_POST['email']);
  $phone = mysql_real_escape_string($_POST['phone']);
  $mobile = mysql_real_escape_string($_POST['mobile']);
  $DOB = $_POST['date']."/".$_POST['month']."/".$_POST['year'];
  $city = mysql_real_escape_string($_POST['city']);
  $address = mysql_real_escape_string($_POST['address']);
  $gender = mysql_real_escape_string($_POST['gender']);
  $query = "INSERT INTO Customer (Username,Name,Password,Email,Address,DOB,City,Phone,Gender, Mobile) VALUES('$username','$name','$encpass','$email','$address','$DOB','$city','$phone','$gender','$mobile')";
  $result = mysql_query($query);
  if(!$result){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Dang ki khong thanh cong. Thu lai lan sau!</h3>".mysql_error();
    echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
    unset($_POST['registered']);
  }else{
    echo "<h1>Đăng kí thành công</h1>";
    echo "<h3>Tài khoản của bạn đã được tạo thành công!</h3>";
    echo "<a href='?page=return'>Ấn vào đây để quay trở lại</a>";
    $login = login($username,$password);
    if($login != "pass")
      echo "Could not login!";
  }
  echo "</div>";
}
?>

