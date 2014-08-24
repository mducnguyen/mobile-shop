  <div class='block'>  
<h1>Đăng nhập</h1>
<?php
require_once("authorize.php");
$set_prev_page=0;
if(CheckLogin('customer')){
  returnPage_user();
}elseif(isset($_POST['username']) && $_POST['username'] != ""){
  $username = mysql_real_escape_string($_POST['username']);
  $password = mysql_real_escape_string($_POST['password']);
  $login = login($username, $password);
  if($login == "pass"){
    echo "<h3>Đăng nhập thành công! Xin chào ".$_SESSION['name']."</h3>";
    returnPage_user();
  }else{
    echo "<h3 style='color:red'>Không thể đăng nhập. Vui lòng kiểm tra lại tên tài khoản và mật khẩu!</h3>";
    echo "<a href='?page=login'>Ấn vào đây để thử lại</a>";
  }
}else{
?>
<table>
  <form name="login" action="?page=login" method="POST">
  <tr>
    <td>Tên đăng nhập: </td>
    <td><input type="text" name="username" size="15" /></td>
  </tr>
  <tr>
    <td>Mật khẩu: </td>
    <td><input type="password" name="password" size="15" /></td>
  </tr>
  <input type="hidden" name="login" value="logged in" />
  <tr>
  <td colspan='2' align='center'><input type="submit" name="btnLogin" value="Login"/><br /></td>
  </tr>
  </form>
</table>
<? } ?>
</div>
