<?php
if(!isset($_GET['item']) || $_GET['item'] == NULL)
  $item_per_page = 10;
else
  $item_per_page = $_GET['item'];
$data = Paging('OS',$item_per_page);
?>
<div class="top-bar">
                    <h1>Thêm hệ điều hành</h1>
</div>
<br />
<form name="add_os" action="?page=os_query&action=add" method="POST" >
<div class="table">
<table class="listing form" cellpadding="0" cellspacing="0">
  <tr>
    <th class="full" colspan="2">Thông tin hệ điều hành</th>
  </tr>

  <tr>
    <td width="50%">Tên hệ điều hành</td>
    <td width="50%">
      <input name="OSNAME" type="text" size="30" />
    </td>
  </tr>
    <tr>
    <td>Miêu tả</td>
    <td>
      <input name="OSDESC" type="text" size="30" />
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
                    <h1>Quản lý hệ điều hành</h1>
</div>
<div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th colspan="4" class="full">Danh sách hệ điều hành | Hiển thị: 
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
                            <td><span style="font-weight:bold;"><?echo $row['OSNAME']?></span> - <?echo $row['OSDESC']?></td>
                       
                            <td class="btn"><a href='?page=update_os&id=<?echo $row['ID'];?>'><img src="img/edit-icon.gif" width="16" height="16" alt="" /></a></td>
                      
                            <td class="btn"><a href="#" onclick="confirm_delete('os',<?echo $row['ID']; ?>)"><img src="img/hr.gif" width="16" height="16" alt="Delete" /></a></td>
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
