<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>
<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
$query = "SELECT * FROM AdminGroup WHERE ID = $id";
$result = mysql_query($query);
if($result){
  $row = mysql_fetch_array($result);
  $groupname=$row['GROUPNAME'];
$groupdesc=$row['GROUPDESC'];
$products=$row['PRODUCTS']?"checked='checked'":"";
$admins=$row['ADMINS']?"checked='checked'":"";
$customers=$row['CUSTOMERS']?"checked='checked'":"";
$orders=$row['ORDERS']?"checked='checked'":"";
$news=$row['NEWS']?"checked='checked'":"";
$system=$row['SYSTEM']?"checked='checked'":"";
$feedback=$row['FEEDBACK']?"checked='checked'":"";
}else{
  echo "<h2>Không tìm thấy bài viết nào !</h2>";
  return 0;
}
?>
<div class="top-bar">
                    <h1>Sửa nhóm</h1>
</div>
<br />
<form name="add_admingroup" action="?page=admingroup_query&action=update&id=<?echo $id;?>" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin nhóm</th>
  </tr>

  <tr>
    <td width="50%">Tên nhóm</td>
    <td width="50%">
      <input name="GROUPNAME" value='<?echo $groupname?>' type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Miêu tả</td>
    <td>
      <input name="GROUPDESC" value='<?echo $groupdesc?>' type="text" size="30" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý sản phẩm</td>
    <td>
      <input name="PRODUCTS" <?echo $products?> type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý các quản trị viên khác</td>
    <td>
      <input name="ADMINS" <?echo $admins?> type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý khách hàng</td>
    <td>
      <input name="CUSTOMERS" <?echo $customers?> type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
   <td>Quyền quản lý đơn hàng</td>
    <td>
      <input name="ORDERS" <?echo $orders?> type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý tin tức</td>
    <td>
      <input name="NEWS" <?echo $news?> type="checkbox" value="1" />
    </td>
  </tr>
  <tr>
    <td>Quyền quản lý Góp ý khách hàng</td>
    <td>
      <input name="FEEDBACK" <?echo $feedback?> type="checkbox" value="1" />
    </td>
  </tr>
      <tr>
    <td>Quyền quản lý cài đặt</td>
    <td>
      <input name="SYSTEM" <?echo $system?> type="checkbox" value="1" />
    </td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
</form>

