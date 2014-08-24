<?
include("sendmail.php");
function mail_reply($target_email,$content){
  //Email out the infromation
  $subject = "Reply Feedback";
  $message = "Đây là thư trả lời cho góp ý của bạn:
----------------------------
$content
----------------------------
Chúc bạn có một ngày vui vẻ!"; 
 
  if(!smtpmailer($target_email, GUSER, GNAME, $subject, $message))
    return false;  
  return true; 
}
if(!isset($_GET['email']) || $_GET['email'] == NULL){
  returnPage_admin();
} $email = $_GET['email'];
if(mail_reply($email,$_POST['reply'])){
echo "<h1>Email đã được gửi thành công</h1>";
echo "<a href='?page=manage_feedback'>Ấn vào đây để quay trở lại</a>";
}
?>
