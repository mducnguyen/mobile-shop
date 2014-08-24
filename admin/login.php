<?php
session_start();
require_once("../includes/global.php");
require_once("../includes/mysql.php");
require_once("authorize.php");
if(CheckLogin('admin')){
  returnPage_admin();
}elseif(isset($_POST['username']) && $_POST['username'] != ""){
  $login = login($_POST['username'], $_POST['password']);
  if($login == "pass"){
    echo "Successfully logged in! Welcome ".$_SESSION['admin_name'];
    returnPage_admin();
  }else{
    echo "<span style='color:red'>Could not login. Check your username and password!</span>";
  ?>
  <table>
  <form name="login" action="login.php" method="POST">
  <tr>
    <td>Ten dang nhap:</td>
    <td><input type="text" name="username" size="15" /></td>
  </tr>
  <tr>
  <td>Mat khau:</td>
  <td><input type="password" name="password" size="15" /></td>
  </tr>
  <input type="hidden" name="login" value="logged in" />
  <tr><td colspan='2' align='center'><input type="submit" name="btnLogin" value="Login"/></td></tr>
  </form>
  </table>
  <?
  }
}else{
?>
<table>
  <form name="login" action="login.php" method="POST">
  <tr>
    <td>Ten dang nhap:</td>
    <td><input type="text" name="username" size="15" /></td>
  </tr>
  <tr>
  <td>Mat khau:</td>
  <td><input type="password" name="password" size="15" /></td>
  </tr>
  <input type="hidden" name="login" value="logged in" />
  <tr><td colspan='2' align='center'><input type="submit" name="btnLogin" value="Login"/></td></tr>
  </form>
  </table>

<? } ?>
