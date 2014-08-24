<?php
if(!isset($_GET['item']) || $_GET['item'] == NULL)
  $item_per_page = 10;
else
  $item_per_page = $_GET['item'];
  
$data = Paging('Customer',$item_per_page);
?>
<div class="top-bar">
                    <h1>Quản lý khách hàng</h1>
</div>
<div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th colspan="5" class="full">Danh sách khách hàng | Hiển thị: 
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
                            <td><span style="font-weight:bold;"><?echo $row['NAME']?></span> [<?echo $row['USERNAME'];?>]<br />
                                Địa chỉ: <?echo $row['ADDRESS'];?>
                             </td>
                       
                            <td class="btn"><img src="img/edit-icon.gif" width="16" height="16" alt="" /></td>
                            <td class="btn"><a href="#" onclick="confirm_delete('customer',<?echo $row['ID']; ?>)"><img src="img/hr.gif" width="16" height="16" alt="Delete" /></a></td>
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
