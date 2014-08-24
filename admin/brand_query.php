<?
$set_prev_page = 0;
$NAME = $_POST['BRANDNAME'];
$DESC = $_POST['BRANDDESC'];
if($_GET['action'] == 'add'){
$query = "INSERT INTO Brand(`BRANDNAME`,`BRANDDESC`) VALUES('$NAME','$DESC')";
$result = mysql_query($query);
$success_msg = "<h2>SUSSCESSFULLY INSERTED!!!</h2><h3><a href='?page=manage_brand'>Nhấn vào đây để quay lại</a></h3>";
}else if($_GET['action'] == 'update'){
    if(!isset($_GET['id']) || $_GET['id'] == NULL)
      returnPage_admin();
    $id = $_GET['id'];
    $query = "UPDATE Brand SET `BRANDNAME`='$NAME',`BRANDDESC`='$DESC'";
    $success_msg = "<h2>SUSSCESSFULLY UPDATED!!!</h2><h3><a href='?page=manage_brand'>Nhấn vào đây để quay lại</a></h3>";
  }
if($result){
  echo $success_msg;
}else{
  echo "Failed: ".mysql_error();
}
?>
