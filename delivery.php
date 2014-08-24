<div class='block'>
<?
  if(!CheckLogin('customer')){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Bạn phải đăng nhập trước khi thanh toán</h3>";
    echo "<a href='?page=login'>Ấn vào đây để đăng nhập</a>";
  }else if(count($_SESSION['cart']) == 0){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Không có sản phẩm nào trong giỏ hàng</h3>";
    echo "<a href='?page=home'>Ấn vào đây để về trang chủ</a>";
  }else{
?>
<script type="text/javascript">
function validate(){
	name = document.delivery.name;
	if(name.value=="" || name.value.length < 5) {
		alert("Tên phải chưa ít nhất 5 chữ cái!");
		document.delivery.name.select();
		document.delivery.name.focus();
		return false;
	}
	email = document.delivery.email;
	emailReg = /^[a-z][\w]*@[a-z][\w]*\.[a-z]{2,4}/i;
	if(!emailReg.test(email.value)) {
		alert("Email sai dinh dang!");
	    document.delivery.email.select();
	    document.delivery.email.focus();
	    return false;
	}
	phone = document.delivery.phone;
	if (phone.value == "") {
		alert("Chưa nhập số điên thoại");
		document.delivery.phone.select();
		document.delivery.phone.focus();
		return false;
    }
    mobile = document.delivery.mobile;
  	mobileReg = /^0\d{9,10}$/;
	if (!mobileReg.test(mobile.value)) {
		alert("Di động sai định dạng");
		document.delivery.mobile.select();
		document.delivery.mobile.focus();
		return false;
    }
    address = document.delivery.address;
  	if(address.value=="") {
  		alert("Bạn chưa chọn địa chỉ!");
		document.delivery.address.select();
		document.delivery.address.focus();
		return false;
	}
	alert("Chào "+username.value+" Chúc mừng bạn đã đăng ký thành công");
  return true;
	
 }
 
function fill_info(name,gender,email,phone,mobile,city,address){
  document.delivery.name.value = name;
  document.delivery.email.value = email;
  document.delivery.phone.value = phone;
  document.delivery.city.value = city;
  document.delivery.mobile.value = mobile;
  document.delivery.address.value = address;
  for (var i=0;i<document.delivery.city.options.length;i++) {
    if (document.delivery.city[i].value == city)
        document.delivery.city[i].selected = true;
  }
  if(gender == 1){
    document.delivery.gender[0].checked = true;
  }else{
    document.delivery.gender[1].checked = true;
  }
}
</script>
<?
  if(isset($_SESSION['delivery'])){
    $del_name = $_SESSION['delivery']['name'];
    $del_gender = $_SESSION['delivery']['gender'];
    $del_email = $_SESSION['delivery']['email'];
    $del_phone = $_SESSION['delivery']['phone'];
    $del_mobile = $_SESSION['delivery']['mobile'];
    $del_city = $_SESSION['delivery']['city'];
    $del_address = $_SESSION['delivery']['address'];
    $del_note = $_SESSION['delivery']['note'];
    $del_paymethod = $_SESSION['delivery']['paymethod'];
  }else{
    $del_name = "";
    $del_gender = "1";
    $del_email = "";
    $del_phone = "";
    $del_mobile = "";
    $del_city = "";
    $del_address = "";
    $del_note = "";
    $del_paymethod = "";
  }
?>
  <h1>Thông tin vận chuyển</h1>
<form name="delivery" action="?page=view_order" method="POST">
<table style="border-collapse:collapse; width:100%">
  <tr>
    <? 
    $query = "SELECT * FROM Customer WHERE ID=".$_SESSION['userid'];
    $result = @mysql_query($query);
    $row = @mysql_fetch_array($result);
    extract($row);
    echo "<td colspan='2'><input type=\"checkbox\" id=\"same_info\" onchange=\"fill_info('$NAME','$GENDER','$EMAIL','$PHONE','$MOBILE','$CITY','$ADDRESS')\"/> Thông tin vận chuyển giống thông tin tài khoản</td>"; ?>
  </tr>
<tr>
  <td width="30%">Họ và tên:</td>
  <td ><input type="text" name="name" value='<?echo $del_name;?>' size="30" /></td>
</tr>
<tr>
  <td>Giới tính:</td>
  <?
    $checknam = $del_gender?'checked="checked"':""; 
    $checknu = !$del_gender?'checked="checked"':""; 
  ?>
  <td><input type="radio" name="gender" value="1" <?echo $checknam;?> />Nam <input type="radio" <?echo $checknu; ?> name="gender" value="0" />Nữ</td>
</tr>
<tr>
  <td>Email:</td>
  <td><input type="text" name="email" value='<?echo $del_email;?>' size="30" /></td>
</tr>
<tr>
  <td>Điện thoại:</td>
  <td><input type="text" name="phone" value='<?echo $del_phone;?>' size="30" /></td>
</tr>
<tr>
  <td>Di động:</td>
  <td><input type="text" name="mobile" value='<?echo $del_mobile;?>' size="30" /></td>
</tr>
<tr>
  <td>Thành phố:</td>
  <td>
    <select name="city">
    <?php
    foreach($cities as $name)
      if($name == $del_city)
        echo "<option value='$name' selected='selected'>$name</option>";
      else
        echo "<option value='$name'>$name</option>";
    ?>
    </select>
  </td>
</tr>
<tr>
  <td>Địa chỉ:</td>
  <td><textarea name="address" rows="3" cols="40"><?echo $del_address;?></textarea></td>
</tr>
<tr>
  <td>Ghi chú:</td>
  <td><textarea name="note" rows="3" cols="40"><?echo $del_note;?></textarea></td>
</tr>
<tr>
  <td>Phương thức thanh toán</td>
  <td>
    <select name="paymethod">
      <?
        $check1 = $del_paymethod=="Gửi tiền qua bưu điện"?"selected='selected'":"";
        $check2 = $del_paymethod=="Thanh toán với nganluong.vn"?"selected='selected'":"";
      ?>
      <option value="Gửi tiền qua bưu điện" <?echo $check1;?>>Gửi tiền qua bưu điện</option>
      <option value="Thanh toán với nganluong.vn" <?echo $check2;?>>Thanh toán với nganluong.vn</option>
    </select>
  </td>
</tr>
<tr>
  <td colspan="2" style="text-align:center;">
  <input type="hidden" name="delivery" value="delivery" />
  <input type="submit" style="font-size:13px; padding: 5px" class='button'  name="btnsubmit" value="Tiếp tục"  onclick="return validate();" />
  <input type="reset" style="font-size:13px; padding: 5px"   name="btnReset" value="Làm lại" />
  <a href='?page=cart'><input type='button' name='goback' style="font-size:13px; padding: 5px" value='Quay lại' /></a>
  </td>
</tr>
</table>
</form>
<? } ?>
</div>
