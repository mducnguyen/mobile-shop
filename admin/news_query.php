<?
$set_prev_page = 0;
$TITLE = mysql_real_escape_string($_POST['TITLE']);
$DESCRIPTION = mysql_real_escape_string($_POST['DESCRIPTION']);
$CONTENT = mysql_real_escape_string($_POST['CONTENT']);
$IMPORTANT = mysql_real_escape_string($_POST['IMPORTANT']);
$THUMBNAIL = mysql_real_escape_string($_POST['THUMBNAIL']);
$ADMIN_ID = $_SESSION['admin_id'];
if($_GET['action'] == 'add'){
$query = "INSERT INTO News( `TITLE`,`DESCRIPTION`,`CONTENT`,`IMPORTANT`,`THUMBNAIL`,`ADMIN_ID`)
          VALUES('$TITLE','$DESCRIPTION','$CONTENT','$IMPORTANT','$THUMBNAIL','$ADMIN_ID')";
$success_msg = "<h2>SUSSCESSFULLY INSERTED!!!</h2><h3><a href='?page=manage_news'>Nhấn vào đây để quay lại</a></h3>";
}else if($_GET['action'] == 'update'){
    if(!isset($_GET['id']) || $_GET['id'] == NULL)
      returnPage_admin();
    $id = $_GET['id'];
    $query = "UPDATE News SET `TITLE`='$TITLE',`DESCRIPTION`='$DESCRIPTION', `IMPORTANT` = '$IMPORTANT',
          `THUMBNAIL`='$THUMBNAIL', `ADMIN_ID`='$ADMIN_ID', `CONTENT`='$CONTENT' WHERE ID=$id";
    $success_msg = "<h2>SUSSCESSFULLY UPDATED!!!</h2><h3><a href='?page=manage_news'>Nhấn vào đây để quay lại</a></h3>";
  }
$result = mysql_query($query);
if($result){
  echo $success_msg;
}else{
  echo "Failed: ".mysql_error();
}
?>
