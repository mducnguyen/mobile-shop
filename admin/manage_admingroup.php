<?php
if(!isset($_GET['item']) || $_GET['item'] == NULL)
  $item_per_page = 10;
else
  $item_per_page = $_GET['item'];
  
$data = Paging('AdminGroup',$item_per_page);
?>
<div class="top-bar">
                    <h1>Thêm nhóm</h1>
</div>
<br />
<form name="add_admingroup" action="?page=admingroup_query&action=add" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin nhóm</th>
  </tr>

  <tr>
    <td width="50%">Tên nhóm</td>
    <td width="50%">
      <input name="GROUPNAME" type="text" size="30" />
    </td>
  </tr>
  <tr>
    <td>Miêu tả</td>
    <td>
      <input name="GROUPDESC" type="text" size="30" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý sản phẩm</td>
    <td>
      <input name="PRODUCTS" type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý các quản trị viên khác</td>
    <td>
      <input name="ADMINS" type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý khách hàng</td>
    <td>
      <input name="CUSTOMERS" type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
   <td>Quyền quản lý đơn hàng</td>
    <td>
      <input name="ORDERS" type="checkbox" value="1" />
    </td>
  </tr>
    <tr>
    <td>Quyền quản lý tin tức</td>
    <td>
      <input name="NEWS" type="checkbox" value="1" />
    </td>
  </tr>
  <tr>
    <td>Quyền quản lý Góp ý khách hàng</td>
    <td>
      <input name="FEEDBACK" type="checkbox" value="1" />
    </td>
  </tr>
      <tr>
    <td>Quyền quản lý cài đặt</td>
    <td>
      <input name="SYSTEM" type="checkbox" value="1" />
    </td>
  </tr>
  <tr>
    <td colspan="2"><center><input type="submit" name="btnsubmit" value="Lưu" />
  <input type="reset" name="btnreset" value="Reset" /></center></td>
  </tr>
  </table>
</div>
</form>
<div class="top-bar">
                    <h1>Quản lý nhóm quản trị viên</h1>
</div>
<div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th colspan="4" class="full">Danh sách nhóm | Hiển thị: 
                            <select name="item_per_page" onchange="<?echo $data['js_itemperpage'];?>">
                              <?php
                                $list = array(10,20,30,50,100);
                                foreach($list as $value){
                                  if($value == $item_per_page)
                                    echo "<option value=\"$value\" selected=\"selected\">$value</option>";
                                  else
                                    echo "<option value=\"$value\">$value</option>";
                                }
                              ?>
                            </select>
                            </th>
                        </tr>
      
                        <?php while($row = mysql_fetch_array($data['result'])){ ?>
                        <tr>
                            <td><span style="font-weight:bold;"><?echo $row['GROUPNAME']?></span> - <?echo $row['GROUPDESC'];?></td>
                       
                            <td class="btn"><a href='?page=update_admingroup&action=update&id=<?echo $row['ID'];?>'><img src="img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                            <td class="btn"><a href="#" onclick="confirm_delete('admin_group',<?echo $row['ID']; ?>)"><img src="img/hr.gif" width="16" height="16" alt="Delete" /></a></td>
                        </tr>
 <? } ?>
                        <tr>
                        <th colspan="4" style="text-align:right">
                        <form onsubmit="<?echo $data['js_pagejump'];?>">
                        <?echo $data['backbtn']." ".$data['nextbtn']; ?>
                        <strong>Đến trang: </strong>
                        <input type="text" size="1" id="pagejump" value="<?echo $data['currentpage'];?>" />
                        /<span class="style1"><?echo $data['pagenum'];?></span>
                        <input type="submit" value="Đi"> 
                       </form> 
                        </th>
                      </tr>
                    </table>
                </div>
