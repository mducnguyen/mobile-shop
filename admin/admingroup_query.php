<?
$set_prev_page = 0;
$groupname=$_POST['GROUPNAME'];
$groupdesc=$_POST['GROUPDESC'];
$products=$_POST['PRODUCTS']?1:0;
$admins=$_POST['ADMINS']?1:0;
$customers=$_POST['CUSTOMERS']?1:0;
$orders=$_POST['ORDERS']?1:0;
$news=$_POST['NEWS']?1:0;
$system=$_POST['SYSTEM']?1:0;
$feedback=$_POST['FEEDBACK']?1:0;
if($_GET['action'] == 'add'){
$query = "INSERT INTO AdminGroup( `GROUPNAME`,`GROUPDESC`,`PRODUCTS`,`ADMINS`,`CUSTOMERS`,`ORDERS`,`NEWS`,`SYSTEM`,`FEEDBACK`) VALUES('$groupname','$groupdesc','$products','$admins','$customers','$orders','$news','$system','$feedback')";
$success_msg = "<h2>SUSSCESSFULLY INSERTED!!!</h2><h3><a href='?page=manage_admingroup'>Nhấn vào đây để quay lại</a></h3>";
}else if($_GET['action'] == 'update'){
    if(!isset($_GET['id']) || $_GET['id'] == NULL)
      returnPage_admin();
    $id = $_GET['id'];
    $query = "UPDATE AdminGroup SET `GROUPNAME`='$groupname', `GROUPDESC`='$groupdesc', `PRODUCTS`='$products', `ADMINS`='$admins', 
    `NEWS`='$news', `ORDERS`='$orders', `CUSTOMERS`='$customer', `SYSTEM`='$system', `FEEDBACK`='$feedback' WHERE ID=$id";
    
    $success_msg = "<h2>SUSSCESSFULLY UPDATED!!!</h2><h3><a href='?page=manage_admingroup'>Nhấn vào đây để quay lại</a></h3>";
  }
$result = mysql_query($query);
if($result){
  echo $success_msg;
}else{
  echo "Failed: ".mysql_error();
}
?>
