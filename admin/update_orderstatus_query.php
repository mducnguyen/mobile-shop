<? $set_prev_page =0;
if(isset($_POST['status'])){
  $status = $_POST['status'];
  $id = $_POST['orderid'];
  $query = "UPDATE `Order` SET `STATUS`='$status' WHERE ID='$id'";
  $result = mysql_query($query);
  if($result)
    header("location:?page=view_order&id=$id");
}?>
