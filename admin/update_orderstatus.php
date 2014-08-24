<?

if(!isset($_GET['id']) || $_GET['id'] == NULL){
  returnPage_admin();
} $id = $_GET['id'];
$query = "SELECT STATUS FROM `Order` WHERE ID=$id";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$status = $row['STATUS'];
?>
<div class="top-bar">
  <h1>Sửa trạng thái đơn hàng</h1>
</div>
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
<form action='index.php?page=update_orderstatus_query' method='POST'>
  <tr>
    <td width='50%'>Trạng thái đơn hàng #<?echo $id?> </td>
    <td><input type='text' name='status' value='<?echo $status?>' size='30'/></td>
    <input type='hidden' name='orderid' value='<?echo $id?>' />
  </tr>
  <tr>
  <th colspan='2' style='text-align:center'><input type='submit' name='btnsubmit' value='Thay đổi'/></th>
  </tr>
  </form>
</table>
</div>
