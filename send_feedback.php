<?
include_once('./securimage/securimage.php');	 
$securimage = new Securimage();
?>
<div class="block">
<?
  $securimage = new Securimage();
  $set_prev_page = 0;
  if(!isset($_POST['feedback_submit']))
    header("location:?page=contact");
  $name = mysql_real_escape_string($_POST['NAME']);
  $email = mysql_real_escape_string($_POST['EMAIL']);
  $phone = mysql_real_escape_string($_POST['PHONE']);
  $address = mysql_real_escape_string($_POST['ADDRESS']);
  $content = mysql_real_escape_string($_POST['CONTENT']);

  if($name == "" || $email == "" || $content == "" ){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Bạn chưa nhập đầy đủ thông tin yêu cầu.</h3>";
    echo "<a href='?page=contact'>Ấn vào đây để quay trở lại</a>";
  }else if(!email_validate($email)){
    echo "<h1>Có lỗi xảy ra</h1>";
    echo "<h3>Email không hợp lệ.</h3>";
    echo "<a href='?page=contact'>Ấn vào đây để quay trở lại</a>";
  }else if($securimage->check($_POST['captcha_code']) == false) {
    echo "The security code entered was incorrect.<br /><br />";
    echo "Please go <a href='javascript:history.go(-1)'>back</a> and try again.";
    exit;
  }else{
    $query = "INSERT INTO Feedback(`NAME`,`EMAIL`,`ADDRESS`,`PHONE`,`CONTENT`) VALUES('$name','$email','$address','$phone','$content') ";
    $result = mysql_query($query);
    if(!$result){
      echo "<h1>Có lỗi xảy ra</h1>";
      echo "<h3>Không thể kết nối đến cơ sở dữ liệu. Xin vui lòng thử lại sau</h3>";
      echo "<a href='?page=contact'>Ấn vào đây để quay trở lại</a>";
      echo mysql_error();
    }else{
      echo "<h1>Gửi thành công</h1>";
      echo "<h3>Góp ý của bạn đã được gửi vào hệ thống. Chúng tôi sẽ phản hồi sớm nhất có thể</h3>";
      echo "<a href='?page=contact'>Ấn vào đây để quay trở lại</a>";
    }
  }
?>
</div>
