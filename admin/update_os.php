<?php 
if(!isset($_GET['id']) || $_GET['id'] == NULL)
  returnPage_admin();
$id = $_GET['id'];
$query = "SELECT * FROM OS WHERE ID = $id";
$result = mysql_query($query);
if($result){
  $row = mysql_fetch_array($result);
}else{
  echo "<h2>Không tìm thấy hệ điều hành nào !</h2>";
  return 0;
}
$name=$row["OSNAME"];
$description=$row["OSDESC"];		

 ?>
<div class="top-bar">
<h1>Cập nhật hệ điều hành</h1>
</div>
<br />
<form name="add_product" action="?page=os_query&action=update&id=<?echo $id;?>" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
   <tr>
    <th class="full" colspan="2">Thông tin hệ điều hành</th>
  </tr>

  <tr>
    <td width="50%">Tên hệ điều hành</td>
    <td width="50%">
      <input name="OSNAME" type="text" value='<?echo $name;?>' size="30" />
    </td>
  </tr>
    <tr>
    <td>Miêu tả</td>
    <td>
      <input name="OSDESC" type="text" value='<?echo $description;?>' size="30" />
    </td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
  
</form>
