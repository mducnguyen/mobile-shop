<?
$set_prev_page = 0;
$NAME = $_POST['OSNAME'];
$DESC = $_POST['OSDESC'];
if($_GET['action'] == 'add'){
$query = "INSERT INTO OS(`OSNAME`,`OSDESC`) VALUES('$NAME','$DESC')";
$success_msg = "<h2>SUSSCESSFULLY INSERTED!!!</h2><h3><a href='?page=manage_os'>Nhấn vào đây để quay lại</a></h3>";
}else if($_GET['action'] == 'update'){
    if(!isset($_GET['id']) || $_GET['id'] == NULL)
      returnPage_admin();
    $id = $_GET['id'];
    $query = "UPDATE OS SET `OSNAME`='$NAME',`OSDESC`='$DESC' WHERE ID=$id";
    $success_msg = "<h2>SUSSCESSFULLY UPDATED!!!</h2><h3><a href='?page=manage_os'>Nhấn vào đây để quay lại</a></h3>";
  }
$result = mysql_query($query);
if($result){
  echo $success_msg;
}else{
  echo "Failed: ".mysql_error();
}
?>
