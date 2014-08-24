<?php
$set_prev_page = 0; // Tell the system not to save this page into visited page
if(!isset($_GET['type']) || !isset($_GET['id']) || $_GET['type'] == NULL || $_GET['id'] == NULL){
  returnPage_admin();
}
  switch($_GET['type']){
    case 'product':
      if(CheckPermission('admin_product'))
        $table = "Product";
      break;
    case 'admin':
      if(CheckPermission('admin_admin'))
      $table = "Admin";
      break;
    case 'admin_group':
      
      $table = "AdminGroup";
      break;
    case 'comment':
      if(CheckPermission('admin_product'))
      $table = "comment";
      break;
    case 'image':
      if(CheckPermission('admin_product'))
      $table = "Image";
      break;
    case 'news':
      if(CheckPermission('admin_news'))
      $table = "News";
      break;
    case 'order':
      if(CheckPermission('admin_order'))
      $table = "`Order`";
      break;
    case 'os':
      if(CheckPermission('admin_product'))
      $table = "OS";
      break;
    case 'brand':
      if(CheckPermission('admin_product'))
      $table = "Brand";
      break;
    case 'customer':
      if(CheckPermission('admin_customer'))
      $table = "Customer";
      break;
    case 'feedback':
      if(CheckPermission('admin_feedback'))
      $table = "Feedback";
      break;
    default: returnPage_admin();
  }
  if(!$table)
    returnPage_admin();
$query = "DELETE FROM $table WHERE ID=".$_GET['id'];
echo $query;
$success_msg = "<h2>SUSSCESSFULLY DELETE!!!</h2><h3><a href='?page=return'>Nhấn vào đây để quay lại</a></h3>";
$result = mysql_query($query);
if($query){
  echo $success_msg;

}else{
  echo "Failed: ".mysql_error();
  echo "<br />";
  echo "<a href='?page=return'>Click here to return</a>";
}
?>

