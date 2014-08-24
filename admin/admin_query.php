<?
$set_prev_page = 0;
$username=$_POST['USERNAME'];
$password=md5(md5($_POST['PASSWORD']));
$name=$_POST['NAME'];
$email=$_POST['EMAIL'];
$gender=$_POST['GENDER'];
$address=$_POST['ADDRESS'];
$groupid=$_POST['GROUP_ID'];
if($_GET['action'] == 'add'){
$query = "INSERT INTO Admin( `USERNAME`,`PASSWORD`,`NAME`,`EMAIL`,`GENDER`,`ADDRESS`,`GROUP_ID`)
          VALUES('$username','$password','$name','$email','$gender','$address','$groupid')";
$success_msg = "<h2>SUSSCESSFULLY INSERTED!!!</h2><h3><a href='?page=manage_admin'>Nhấn vào đây để quay lại</a></h3>";
}else if($_GET['action'] == 'update'){
   if(!isset($_GET['id']) || $_GET['id'] == NULL)
     returnPage_admin();
   $id = $_GET['id'];
   $query = "UPDATE Admin SET `USERNAME`='$username', `PASSWORD`='$password', `NAME`='$name', `EMAIL`='$email', `GENDER`='$gender'
   , `ADDRESS`='$address', `GROUP_ID`='$groupid' WHERE ID=$id";
   $success_msg = "<h2>SUSSCESSFULLY UPDATED!!!</h2><h3><a href='?page=manage_admin'>Nhấn vào đây để quay lại</a></h3>";
}
$result = mysql_query($query);
if($result){
  echo $success_msg;
}else{
  echo "Failed: ".mysql_error();
}
?>
