<?
include("sendmail.php");
function mail_pass($password,$target_email){
  //Email out the infromation
  $subject = "Mat khau moi";
  $message = "Đây là mật khẩu mới của bạn:
----------------------------
Mật khẩu: $password
----------------------------
Ấn vào đây để đăng nhập: http://site.url/login.php
Lưu ý rằng thông tin về mật khẩu của bạn đã được mã hóa trong cơ sở dữ liệu của chúng tôi
Vui lòng không trả lời email. Email được tự động gửi đi từ hệ thống
Chúc bạn có một ngày vui vẻ!"; 
 
  if(!smtpmailer($target_email, GUSER, GNAME, $subject, $message))
    return false;  
  return true; 
}
function send_new_pass($input, $type){
  // Generate new password
  $randpass = md5(uniqid(rand()));
  // Take 8 first letter from previously created password
  // to be the new password
  $randpass = substr($randpass,0,8);
  // encrypt the new password
  $enc_pass = md5(md5($randpass));
  
  $query = "UPDATE `Customer` SET PASSWORD = '$enc_pass' WHERE $type='$input'";
  $result = mysql_query($query);
  if(!$result)
    return false;
  // Get the person's email address
  $query = "SELECT EMAIL FROM `Customer` WHERE $type='$input'";
  $result = mysql_query($query);
  $row = mysql_fetch_array($result);
  $target_email = $row['EMAIL'];
  mail_pass($randpass,$target_email); 
  return true;
}
?>
<div class="block">
<?
  $set_prev_page = 0;
  if(!isset($_POST['forgot_submit']))
    returnPage_user(); 

  $input = $_POST['info'];
  
  $type = strchr($input,'@')?'EMAIL':'USERNAME';
  $validate = true;
  if($type == "EMAIL"){
    if(!email_validate($input))
      $validate = false; 
  }else if($type == "USERNAME"){
    if(!ctype_alnum($input))
      $validate = false;
  }else{
    return;
  }
  if(!$validate){
    echo "<h1>Có lỗi xảy ra:</h1>";
    echo "<h3>Tên đăng nhập hay email bạn nhập không chính xác, xin mới kiểm tra lại.</h3>";
    echo "</div>"; 
  }else{
    $input = mysql_real_escape_string($input);
    $query = "SELECT USERNAME,EMAIL FROM Customer WHERE $type='$input'";
    $result = mysql_query($query);
    if(!$result || mysql_num_rows($result) == 0){
      echo "<h1>Có lỗi xảy ra:</h1>";
      echo "<h3>Email hoặc tên đăng nhập không tồn tại trong cơ sở dữ liệu. Xin mời thử lại</h3>";
      echo "</div>"; 
    }else{
      $login_url = $site_url."/login.php";
      if(send_new_pass($input,$type)){
        echo "<h1>Gửi thành công</h1>";
        echo "<h3>Hệ thống đã gửi email đến hòm thư của bạn. Thư sẽ đến trong vài phút nữa, xin vui lòng kiểm tra hòm thư!</h3>";
        echo "</div>"; 
        }else{
      echo "<h1>Có lỗi xảy ra:</h1>";
      echo "<h3>Không thay đổi được hoặc không thể gửi mail. Xin mời thử lại</h3>";
      echo "<h3>Quý khách vui lòng liên hệ quản trị website để có thêm thông tin.</h3>";
        echo "</div>"; 
        }
      }
    }
?>
